<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'trans_id',
        'email',
        'bank',
        'account_no',
        'account_name',
        'amount',
        'status',
    ];
    public $timestamps = true;


    public function user(){
        return $this->belongsTo(User::class);
    }
    

}
