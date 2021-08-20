<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trade;
use App\Models\Withdrawal;
use App\Models\Giftcard;
use App\Models\Cryptoasset;
use App\Models\User;
use App\Models\Nairawallet;
use App\Models\Kyc;
use DB;
class AdminController extends Controller
{
    public function __construct(){
        $this->middleware(['isadmin','auth']);
    }
    public function index(){
        $total_wallet_balance = Nairawallet::sum('amount');
        $admin  =   User::where(['isadmin'=>1,'isadmin'=>2])->count();
        $user   =   User::where('isadmin',0)->count();
        $bank   =   DB::table('bank')->count();
        $kyc    =   Kyc::where('status','pending')->count();
        $paid_withdrawal = Withdrawal::where('status','paid')->count();
        $pending_withdrawal = Withdrawal::where('status','pending')->count();
        $crypto  = Cryptoasset::all()->count();
        $giftcards = Giftcard::all()->count();
        $pending =  Trade::where(['status'=>'pending'])->count();
        $fail    =  Trade::where(['status'=>'failed'])->count();
        $paid    =  Trade::where(['status'=>'paid'])->count();
        return view('admin.index',[
            'pending'=> $pending,
            'fail' => $fail,
            'paid'=>$paid,
            'giftcard'=> $giftcards,
            'crypto'=>$crypto,
            'paid_withdrawal'=>$paid_withdrawal,
            'bank'=>$bank,
            'pending_withdrawal'=>$pending_withdrawal,
            'admin'=> $admin,
            'user'=> $user,
            'kyc'=> $kyc,
            'total_wallet_balance'=> $total_wallet_balance
        ]);
    }

    public function addAdmin(Request $request){
        $data = User::where('email',$request->email)->get();

        if(count($data) == 1){
            $data  = User::find($data[0]->id);
            $data->isadmin = '1';
            $data->save();

            return $data;
        }else{
            return 'not found';
        }
    }
    public function superAdmin(){
        $admin = User::where('isadmin','!=',0)->latest()->get();

        return view('admin.addadmin',compact('admin'));
    }

    public function removeAdmin(Request $request){
        $data  = User::find($request->id);
        $data->isadmin = '0';
        $data->save();

        return 'true';
    }
}
