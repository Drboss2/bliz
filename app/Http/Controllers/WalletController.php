<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Withdrawal;
use App\Models\Nairawallet;
use App\Models\Kyc;
use App\Models\Timer;
use App\Mail\cardMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WalletController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }
    public function index(){
        return view('user.dashboard.wallet');
    }
    public function pag(){
       $data   =  DB::table('transactions')->latest()->where('user_id',auth()->user()->id)->paginate(10);
       $select =  DB::table('bank')->orderBy('bank_name','asc')->get();

       return view('user.dashboard.wallet',compact(['data','select']));
    }
    public function pag_ajax(Request $request){
        if($request->ajax()){
            $data =  DB::table('transactions')->latest()->where('user_id',auth()->user()->id)->paginate(10);
            return view('user.dashboard.pagination',compact('data'))->render();
        }
    }
    public function getPin(){
        return auth()->user()->pin->pin;
    }
    public function withdrawalRequest(Request $request){
        $this->validate($request,[
            'bank' =>'required',
            'account_no' =>'required',
            'account_name' =>'required',
            'a' => 'required',
        ]);

        if($request->input('a') > auth()->user()->wallet->amount){
            return back()->with('error','Insuficent balance');
        }if($request->pin != auth()->user()->pin->pin){
            return back()->with('error_pin','Transaction pin not correct');
        }else{
            $request->session()->put('bank',$request->input('bank'));
            $request->session()->put('account_no',$request->input('account_no'));

            $request->session()->put('account_name',$request->input('account_name'));

            $request->session()->put('a',$request->input('a'));

            return view('user.dashboard.confirm',[
                'bank' =>      $request->session()->get('bank'),
                'account_no'=> $request->session()->get('account_no'),
                'account_name'=> $request->session()->get('account_name'),
                'a'=> $request->session()->get('a'),
            ]);
        }
    }

    public function confirmAndPaid(Request $request){ // confirm withdrawal request and sent to db
        $data =  Withdrawal::where('user_id' ,'=' ,auth()->user()->id)->sum('amount');
        if(!auth()->user()->kyc){
            if($data > 1000000){
                return redirect()->route('wallet')->with('erro','Your have surpase your withdrawal limit Because Your Kyc is not Verified');
            }else{
                if($request->session()->has('a')){
                    $table               = new Withdrawal;
                    $table->user_id      = auth()->user()->id;
                    $table->phone        = auth()->user()->phone;

                    $table->trans_id     = random_int(11111111,99999999);
                    $table->email        = auth()->user()->email;
                    $table->bank         = $request->session()->get('bank');
                    $table->account_no   = $request->session()->get('account_no');
                    $table->account_name = $request->session()->get('account_name');
                    $table->amount       = $request->session()->get('a');
                    $table->status       = 'pending';
                    $table->save();

                    Nairawallet::where('user_id',auth()->user()->id)->decrement('amount',$request->session()->get('a'));

                    DB::table('transactions')->insert([
                        'user_id'  => auth()->user()->id,
                        'email'  => auth()->user()->email,
                        'order_id' => random_int(11111111,99999999),
                        'type'     => 'wallet',
                        'reason'   => 'withdrawal',
                        'amount'   =>  $request->session()->get('a'),
                        'status'   => 'pending',
                        "created_at" => date('Y-m-d H:i:s'),
                        "updated_at" => date('Y-m-d H:i:s'),
                    ]);

                    $data = array(
                        'm'=> auth()->user()->name. ' Your withdrawal request of NGN ' . $request->session()->get('a').' has been submited',
                    );

                    $request->session()->forget(['bank', 'account_no','account_name','a']);

                    return redirect()->route('wallet')->with('okay','Your withdrawal request has been submited');
                }  
            } 
        }elseif(auth()->user()->kyc->count() == 1){
            if(auth()->user()->kyc->status == 'success'){
                if($request->session()->has('a')){
                    $table               = new Withdrawal;
                    $table->user_id      = auth()->user()->id;
                    $table->phone        = auth()->user()->phone;

                    $table->trans_id     = random_int(11111111,99999999);
                    $table->email        = auth()->user()->email;
                    $table->bank         = $request->session()->get('bank');
                    $table->account_no   = $request->session()->get('account_no');
                    $table->account_name = $request->session()->get('account_name');
                    $table->amount       = $request->session()->get('a');
                    $table->status       = 'pending';
                    $table->save();

                    Nairawallet::where('user_id',auth()->user()->id)->decrement('amount',$request->session()->get('a'));

                    DB::table('transactions')->insert([
                        'user_id'  => auth()->user()->id,
                        'email'  => auth()->user()->email,
                        'order_id' => random_int(11111111,99999999),
                        'type'     => 'wallet',
                        'reason'   => 'withdrawal',
                        'amount'   =>  $request->session()->get('a'),
                        'status'   => 'pending',
                        "created_at" => date('Y-m-d H:i:s'),
                        "updated_at" => date('Y-m-d H:i:s'),
                    ]);

                    $data = array(
                        'm'=> auth()->user()->name. ' Your withdrawal request of NGN ' . $request->session()->get('a').' has been submited',
                    );

                    $request->session()->forget(['bank', 'account_no','account_name','a']);

                    return redirect()->route('wallet')->with('okay','Your withdrawal request has been submited');
                } 
            }else{
                if($data > 1000000){
                  return redirect()->route('wallet')->with('erro','Your have surpase your withdrawal limit Because Your Kyc is not Verified');
               }
            }
        }
   }
}
