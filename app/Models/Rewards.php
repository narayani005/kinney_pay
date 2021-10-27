<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

date_default_timezone_set('Asia/Kolkata');

class Rewards extends Model
{
    use HasFactory;
    protected $fillable = [
        'trans_to',
        'trans_by',
        'reward_amt'   
    ];
    public $timestamps = true;
}
