<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trade;
use App\Models\User;
use App\Models\Nairawallet;
use App\Models\Transactions;
use App\Mail\cardMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;


class TradeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('isadmin');
    }

    public function index(){
        $data = Trade::where('status','pending')->latest()->paginate(10); 
        return view('admin.trade',[
            'data'=>$data,
        ]);
    }
    public function approveTrade($id){
        $data = Trade::where('id',$id)->get();
        $user_id = $data[0]->user_id;
        $amount = $data[0]->expected_amount;

        Nairawallet::where('user_id',$user_id)->increment('amount',$amount);
        Trade::where('id',$id)->update(['status'=>'paid']);
        $u = User::where('id',$user_id)->get();

        $user           = new Transactions;
        $user->user_id  = $user_id;
        $user->type     = 'wallet';
        $user->reason   = 'Trade funded';
        $user->order_id = random_int(1111111111,9999999999);
        $user->amount   = $amount;
        $user->status   = 'successful';
        $user->save();

        $data = array(
            'm'=> $u[0]->name.' Your Internal wallet with has been credited with NGN' .$amount
        );

        Mail::to($u[0]->email)->send(new cardMail($data));

        return 'trade status updated';
    }
    public function declinedTrade($id){
        $data = Trade::where('id',$id)->get();
        $user_id = $data[0]->user_id;
        $u = User::where('id',$user_id)->get();

        $user = Trade::where('id',$id)->update(['status'=>'failed']);

        $data = array(
            'm'=> $u[0]->name. ' Your Trade was Declined'
        );
        Mail::to($u[0]->email)->send(new cardMail($data));
        return 'trade status updated';
    }

    public function allPaidTrade(){
       $data = Trade::where('status','paid')->latest()->paginate(10);
        return view('admin.paid',[
           'data'=>$data,
       ]); 
    }

    public function allDeclinedTrade(){
       $data = Trade::where('status','failed')->latest()->paginate(10);

       return view('admin.rejected',[
           'data'=>$data,
       ]); 
    }

    public function downloadFile($id){
        $file = Trade::find($id);
        $header = [
            'Content-Type:  Application/image',
        ];
       return Storage::download(storage_path('images/'.$file->assets_image,$file->assets_name,$header));
    }
}
