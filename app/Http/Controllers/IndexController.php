<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Trade;
use App\Models\Subscribe;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use DB;

class IndexController extends Controller
{
    public function index(){
       $user = User::all()->count();
       $trade = Trade::all()->count();
       

        $btc= DB::table('crypto_details')
        ->join('cryptoassets', 'crypto_details.cryptoassets_id', '=', 'cryptoassets.id')
        ->select('crypto_details.*', 'cryptoassets.*')
        ->get();

       return view('user.index',[
           'user'=> $user,
           'trade'=>$trade,
           'btc'=> $btc,
       ]);
    }


    public function newsLetters(Request $request){ // store subscribers in db
        $this->validate($request,[
            'email'    => 'required|string|unique:subscribes,email',
        ]);

       $sub = new Subscribe;
       $sub->email = $request->email;
       $sub->save();

       return "sent";
    }

}
