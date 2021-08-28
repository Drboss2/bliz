<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','order_id','assets_image',
    'assets_name','assets_type','price','denomination','expected_amount','status','admin','admin_id'];

    public $timestamps = true;
}
