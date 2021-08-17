<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cryptoasset extends Model
{
    use HasFactory;

    protected $fillable = ['asstes','image','address'];

    public $timestamps = true;
}
