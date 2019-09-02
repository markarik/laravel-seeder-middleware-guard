<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;


class Admin extends Authenticatable implements MustVerifyEmail,Auditable
{
    protected $guard = 'admin';

    use Notifiable;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'name','email','password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
