<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

date_default_timezone_set('Asia/Kolkata');

class Beneficiar extends Model
{
    use HasFactory;

    protected $table = 'beneficiars';

    protected $fillable = [
        'benefi_name',
        'user_id',
        'benefi_id'
        
    ];
    public $timestamps = true;
    
    
}
