<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

date_default_timezone_set('Asia/Kolkata');

class Redeem extends Model
{
    use HasFactory;
    protected $fillable = [
        'points',
        'equal_amt',
        'min_points' ,  
        'country_code'    
    ];
    public $timestamps = true;
}
