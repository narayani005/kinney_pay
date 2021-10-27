<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

date_default_timezone_set('Asia/Kolkata');

class BalanceAlert extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'avail_amt'
        
    ];
    public $timestamps = true;
}
