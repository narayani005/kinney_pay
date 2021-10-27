<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

date_default_timezone_set('Asia/Kolkata');

class BankAccount extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'bank_name',
        'bank_acc_name',
        'bank_acc_id',
        'branch_name',
        'ifsc_code'
        
    ];
    public $timestamps = true;
}
