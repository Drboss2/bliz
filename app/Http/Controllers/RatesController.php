<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Giftcard;
use App\Models\Giftcard_detail;
use App\Models\Cryptoasset;

class RatesController extends Controller
{
    public function __constuct(){
        $this->middleware('auth');
    }
    public function index(){
        $rates  =  Giftcard::all();
        $crypto =  Cryptoasset::all();
        return view('user.dashboard.rates',compact(['rates','crypto']));
    }
    public function getRateType(Request $request,$id){
        $rate_type = Giftcard_detail::where(['giftcards_id'=>$id])->get();
        return view('user.dashboard.rates.type',compact('rate_type'));
    }
    public function getRateAmount(Request $request,$id){
        $rate_amount = Giftcard_detail::where(['id'=>$id])->get();
        return $rate_amount;
    }
    public function getCrytoAmount(Request $request,$id){
        $rate = Cryptoasset::where(['id'=>$id])->get();
        return $rate;
    }

}
