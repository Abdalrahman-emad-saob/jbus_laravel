<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;


class User extends Authenticatable
{
    use CrudTrait;
    use HasApiTokens, HasFactory, Notifiable;
    use Billable;
    // use MustVerifyEmail;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function generateAvatar()
    {
        $icon = new \Jdenticon\Identicon(array(
            'size' => 50,
            'value' => $this->name
        ));

        return $icon->getImageDataUri('svg');
    }

    // enums
    static $superAdmin = 'SUPER_ADMIN';
    static $admin = 'ADMIN';
    static $driver = 'DRIVER';
    static $passenger = 'PASSENGER';


    // relationships
    // admin


    // driver
    public function bus()
    {
        return $this->hasOne(Bus::class, 'driver_id', 'id');
    }

    // passenger

    public function passengerProfile()
    {
        return $this->hasOne(PassengerProfile::class, 'passenger_id', 'id');
    }

    public function otp()
    {
        return $this->hasOne(OTP::class, 'passenger_id', 'id');
    }

    public function favoritePoints()
    {
        return $this->hasMany(FavoritePoint::class, 'passenger_id', 'id');
    }

    public function paymentTransactions()
    {
        return $this->hasMany(PaymentTransaction::class, 'passenger_id', 'id');
    }

    public function trips()
    {
        return $this->hasMany(Trip::class, 'passenger_id', 'id');
    }





}
