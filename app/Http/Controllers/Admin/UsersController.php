<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;

class UsersController extends Controller
{
     public function __construct(){
        $this->middleware('auth');
        $this->middleware('isadmin');
    }

    public function index(){
        $data= DB::table('users')
        ->join('nairawallets', 'users.id', '=','nairawallets.user_id')
        ->select('users.*', 'nairawallets.amount')
        ->latest()
        ->paginate(10);
        return view('admin.users',[
            'data'=>$data,
        ]);
    }

    public function checkforPin(){
        return view('admin.pin');
    }

    public function getUserPin($email){
        $data= DB::table('users')->where('email',$email)
        ->join('pins', 'users.id', '=','pins.user_id')
        ->select('pins.pin', 'users.email')->get();
        
        return $data ;
    }
}
