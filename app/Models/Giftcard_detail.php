<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Giftcard_detail extends Model
{
    use HasFactory;

    protected $fillables = ['giftcards_id','card_country','card_type','buying_min','buying_max'];

    public $timestamps = true;

   

}
