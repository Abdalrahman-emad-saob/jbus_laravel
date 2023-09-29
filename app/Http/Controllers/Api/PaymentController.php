<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use App\Models\User;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function createPaymentIntent(Request $request)
    {
        $user = $request->user();
        $amount = $request->input('amount');

        if (!$user->stripe_id) {
            // Create a Stripe customer for the user
            $user->createAsStripeCustomer();
        }

        $payment = $user->pay($amount);

        return response()->json(['client_secret' => $payment->client_secret]);
    }

    public function payForDriver(Request $request)
    {
        $bus = Bus::find($request->bus_id);
        $passengerProfile = Auth::user()->passengerProfile;

        if ($passengerProfile->wallet < $bus->route->fee) {
            return response()->json(['message' => 'Insufficient credits'], 402);
        }

        $passengerProfile->wallet -= $bus->route->fee;

        $passengerProfile->save();

        return response()->json(['message' => 'Payment successful']);
    }

    public function generateQRCode()
    {
        $user = auth()->user(); // Assuming the logged-in user is a driver

        if (!$user->bus()->exists()) {
            return response()->json(['error' => 'QR code generation failed']);
        }

        $qrcodeData = route('payment.pay-driver', ['bus_id' => $user->bus->id], false);

        $result = Builder::create()
            ->writer(new PngWriter())
            ->data($qrcodeData)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size(400)
            ->margin(20)
            ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->build();

        return response()->json(['qrcode' => base64_encode($result->getString()), 'mime' => $result->getMimeType()]);
    }


    public function requestTransfer(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required|integer',
        ]);

        $user = $request->user();

        $qrcodeData = route('payment.transfer', [
            'user_id' => $user->id,
            'amount' => $validatedData['amount'],
        ], false);

        $result = Builder::create()
            ->writer(new PngWriter())
            ->data($qrcodeData)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size(400)
            ->margin(20)
            ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->build();

        return response()->json([
            'qrcode' => base64_encode($result->getString()),
            'mime' => 'image/png', // You can hardcode the MIME type for QR codes
        ]);
    }

    public function transfer(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|integer',
        ]);

        $user = $request->user()->load('passengerProfile');

        if ($user->passengerProfile->wallet < $validatedData['amount']) {
            return response()->json(['message' => 'Insufficient credits'], 402);
        }

        $otherUser = User::with('passengerProfile')->find($validatedData['user_id']);

        $otherUser->passengerProfile->wallet += $validatedData['amount'];
        $user->passengerProfile->wallet -= $validatedData['amount'];

        $user->push(); // Save without triggering events
        $otherUser->push(); // Save without triggering events

        return response()->json(['message' => 'Transferred successfully'], 200);
    }
}
