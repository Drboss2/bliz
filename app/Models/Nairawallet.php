<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nairawallet extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'amount',
    ];

    public $timestamps = true;

    public function user(){
        $this->belongsTo(User::class);
    }
 
}
