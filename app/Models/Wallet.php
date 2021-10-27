<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

date_default_timezone_set('Asia/Kolkata');

class Wallet extends Model
{
    use HasFactory;
    protected $fillable = [
        'wallet_id',
        'trans_to_name',
        'trans_to_id',
        'trans_id', 
        'score',
        'trans_by_id',
        'trans_by_name',
        'trans_type',
        'remark', 
        'status', 
        'created_at', 
        'updated_at'
    ]; 
    protected $primaryKey = 'wallet_id';

    public $timestamps = true;
}
