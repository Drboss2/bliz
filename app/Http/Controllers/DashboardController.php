<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Trade;
use App\Models\Cryptoasset;


class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('rateIndex');
    }
    public function index(){
        $crypto = Cryptoasset::limit(2)->orderBy('assets','desc')->get(); 

        $wallet =   DB::table('transactions')->where(['user_id' => auth()->user()->id,'type'=> 'wallet'])->count();
        $trade   =  Trade::latest()->where(['user_id'=>auth()->user()->id])->paginate(10);
        $pending =  Trade::where(['user_id'=>auth()->user()->id,'status'=>'pending'])->count();
        $fail    =  Trade::where(['user_id'=>auth()->user()->id,'status'=>'failed'])->count();
        $paid    =  Trade::where(['user_id'=>auth()->user()->id,'status'=>'paid'])->count();

       return view("user.dashboard.index",[
           'wallet_count' =>$wallet,
           'trade'=>$trade,
           'pending'=>$pending,
           'fail'=> $fail,
           'paid'=>$paid,
           'crypto'=>$crypto
       ]);
    }

    public function rateIndex(){
        $data= DB::table('giftcard_details')
        ->join('giftcards', 'giftcard_details.giftcards_id', '=', 'giftcards.id')
        ->select('giftcard_details.*', 'giftcards.*')
        ->get();

        $btc= DB::table('crypto_details')
        ->join('cryptoassets', 'crypto_details.cryptoassets_id', '=', 'cryptoassets.id')
        ->select('crypto_details.*', 'cryptoassets.*')
        ->get();

        return view('user.rate',[
            'data'=>$data,
            'btc' => $btc,
        ]);
    }
    
    public function logOut(){
        auth()->logout();

        return redirect('/login');  
    } 
}
