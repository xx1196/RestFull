<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /*
     * Constantes de estado
     */
    const USER_VERIFIED = '1';
    const USER_NOT_VERIFIED = '0';
    const USER_ADMIN = '1';
    const USER_REGULAR = '0';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'verified',
        'verified_token',
        'admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verified_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isVerified()
    {
        return $this->verified == self::USER_VERIFIED;
    }

    public function isAdmin()
    {
        return $this->verified == self::USER_VERIFIED;
    }

    public static function generateVerifiedToken()
    {
        return str_random(40);
    }
}
