<?php

namespace App\Http\Controllers;

use Faker\Core\Number;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Illuminate\Support\Str;



class FirebaseController extends Controller
{
    public function index()
    {

        $data = Firebase::database()
            ->getReference('busses/1')
            ->getValue();

        header("Refresh:5");

        echo '<pre>';
        echo json_encode($data);
        echo str_pad(rand(0, pow(10, 4)-1),4, '0', STR_PAD_LEFT);
        echo '</pre>';
    }


    public function nigg() {
        Firebase::database()
            ->getReference('busses/1')
            ->update([
                'my name is' => request('name'),
                'longlat' => 34.3213
            ]);
    }
}
