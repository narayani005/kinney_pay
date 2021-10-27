<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

date_default_timezone_set('Asia/Kolkata');

class Recharge extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'receiver_id',
        'received_amt' ,  
        'received_date'    
    ];
    public $timestamps = true;
}
