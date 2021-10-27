<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

date_default_timezone_set('Asia/Kolkata');

class MoneyRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'req_user_id',
        'req_amt',
        'status'   
    ];
    public $timestamps = true;
}
