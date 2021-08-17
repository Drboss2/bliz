<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crypto_detail extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'cryptoassets_id',
        'crypto_name',
        'min',
        'max',
        'rate'
    ];
     public $timestamps = true;
     public $table = 'crypto_details';

}
