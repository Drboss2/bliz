<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Withdrawal;
use App\Models\Transactions;
use App\Mail\cardMail;
use Illuminate\Support\Facades\Mail;


class WithdrawalController extends Controller
{
     public function __construct(){
        $this->middleware('isadmin');
        $this->middleware('auth');
    }
    public function index(){
        $data = Withdrawal::where('status','pending')->latest()->paginate(10); 
        return view('admin.withdraw',[
            'data'=>$data
        ]);
    }

    public function approveWithdrawalRequest(Request $request){
        $data = Withdrawal::where('id',$request->id)->get();
        $user_id = $data[0]->user_id;
        $amount = $data[0]->amount;
        $email = $data[0]->email;

        Withdrawal::where('id',$request->id)->update(['status'=>'paid']);

        $user           = new Transactions;
        $user->user_id  = $user_id;
        $user->type     = 'Bank';
        $user->reason   = 'Withdrawal fund Paid out';
        $user->order_id = random_int(1111111111,9999999999);
        $user->amount   = $amount;
        $user->status   = 'successful';
        $user->save();

        $data = array(
        'm'=>  $email. 'Your Withdrawal request of' . $amount . 'has been approved'
        );

       Mail::to($email)->send(new cardMail($data));

        return 'trade status updated';
    }

    public function declinedWithdrawalRequest(Request $request){
       $data = Withdrawal::where('id',$request->id)->get();
       $amount = $data[0]->amount;

       $email = $data[0]->email;
       $user = Withdrawal::where('id',$request->id)->update(['status'=>'decline']);

       $data = array(
        'm'=>  $email.' Your Withdrawal request of NGN ' .$amount. ' was declined'
        );

        Mail::to($email)->send(new cardMail($data));

        return 'trade status updated'; 
    }

    public function allPaidWithdrawalRequest(){
       $data = Withdrawal::where('status','paid')->latest()->paginate(10);

       return view('admin.withdrawpaid',[
           'data'=>$data,
       ]); 
    }

    public function allDeclinedWithdrawalRequest(){
       $data = Withdrawal::where('status','decline')->latest()->paginate(10);
       return view('admin.withdrawfail',[
           'data'=>$data,
       ]); 
    }
}
