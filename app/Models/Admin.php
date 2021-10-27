<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

date_default_timezone_set('Asia/Kolkata');

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'country_code', 'mobile', 'profile_img', 'qrcode', 'is_super', 'status', 'total_amt', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    public $timestamps = true;
}
