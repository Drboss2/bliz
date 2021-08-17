<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function __constuct(){
        $this->middleware('auth');
    }
    public function index(){
        $data =  DB::table('transactions')->latest()->where('user_id',auth()->user()->id)->paginate(10);
        return view('user.dashboard.transaction',compact('data'));
    }
}
