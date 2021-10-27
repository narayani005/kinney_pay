<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

date_default_timezone_set('Asia/Kolkata');

class AddAccount extends Model
{
    use HasFactory;
    protected $fillable = [
        'username',
        'password',
        'email',
        'country_code', 
        'mobile',
        'unique_id',
        'acc_type',
        'acc_id',
        'ref_id', 
        'created_at', 
        'updated_at'
    ]; 
    protected $primaryKey = 'id';

    public $timestamps = true;
}
