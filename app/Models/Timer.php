<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timer extends Model
{
    use HasFactory;
    protected $table = 'timer';
    protected $fillable = ['user_id','date'];

    public $timestamps = true;

    public function Timer(){
        return $this->belongsTo(User::class);
    }

}
