<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

date_default_timezone_set('Asia/Kolkata');

class Config extends Model
{
    use HasFactory;

    protected $table = 'configuration';

    protected $fillable = [
        'currency_type',
        'service_charges'
        
    ];
    public $timestamps = true;
}
