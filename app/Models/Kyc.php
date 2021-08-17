<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kyc extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'state',
        'gender',
        'front_file',
        'back_file'
    ];
    protected $table = 'kyc';

    public $timestamps = true;

     public function user(){
        $this->belongsTo(User::class);
    }

}
