<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
    
    protected $fillable =[
       'user_id',
       'type',
       'amount',
       'status',
       'reason',
       'order_id',
       'email',
    ];

    public $timestamps = true;

    protected $table = 'transactions';
}
