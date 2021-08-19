<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cryptoasset;
use App\Models\Crypto_detail;
use App\Models\Trade;
use App\Mail\cardMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;


class CryptoController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }
    public function index(){
        $data = Cryptoasset::all();
        return view('user.dashboard.trade.crypto',[
            'data'=>$data,
        ]);
    }
    public function getSingelCrypto($id,$name){
        $data= DB::table('crypto_details')->where('cryptoassets_id',$id)
            ->get();

        return view("user.dashboard.trade.cryptosingle",[
            'data'=>$data,
            'name'=>$name,
            'id'=>$id
        ]); 
    }
    public function getSingelCryptoAddress($id){
        $data = DB::table('cryptoassets')->where('id',$id)
            ->get(); 
        return $data;
    }

    public function getCrpto($id){
        $data = Crypto_detail::where(['id'=>$id])->get();
        return response()->json(['data'=>$data]);
    }

    public function sellCryptoRequest(Request $request){
       
        $asset_name     = $request->coin_name;
        $amount         = $request->amount;
        $rate           = $request->prices;
        $total_expected = $request->total_price;
        $proof_img      = $request->file('image');
        $newfilename    = time().'.'.$proof_img->getClientOriginalExtension();

        $request->file('image')->storeAs('public/images',$newfilename);
        $order_id = random_int(1111111110,9999999999);

        Trade::create([
            'user_id'=>auth()->user()->id,
            'order_id'=>$order_id,
            'assets_image' =>$newfilename,
            'assets_name'=>$asset_name,
            'assets_type'=>$asset_name,
            'price'=>$rate,
            'denomination'=>$amount,
            'expected_amount'=>$total_expected,
            'status'=> 'pending',
        ]);
        
        $data = array(
            'm'=> auth()->user()->name.' Your ' .$asset_name.' trade with order id of ' . $order_id. ' Has been successful placed',
        );
        
        Mail::to(auth()->user()->email)->queue(new cardMail($data));

        return redirect()->route('user.dashboard')->with("crypto_success", "Your $asset_name order has been placed");
    }
}
