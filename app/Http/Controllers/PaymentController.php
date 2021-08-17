<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Transactions;
use App\Models\Nairawallet;
use App\Mail\cardMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Paystack;

class PaymentController extends Controller
{

    public function __construct(){
        $this->middleware(['auth']);
    }
    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()
    {
        try{
            return Paystack::getAuthorizationUrl()->redirectNow();
        }catch(\Exception $e) {
            return Redirect::back()->withMessage(['msg'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
        }        
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        if($paymentDetails['status'] == true){
            $user           = new Transactions;
            $user->user_id  = auth()->user()->id;
            $user->type     = 'wallet';
            $user->reason   = 'deposit';
            $user->order_id = $paymentDetails['data']['id'];
            $user->amount   = $paymentDetails['data']['amount'] / 100;
            $user->status   = 'successful';
            $user->save();
            $user->amount;

            Nairawallet::where('user_id',auth()->user()->id)->increment('amount',$user->amount);

            $data = array(
                'm'=> auth()->user()->name.' Your wallet has been funded with NGN' .$user->amount
            );

            Mail::to(auth()->user()->email)->send(new cardMail($data));
         
            return back()->with('success', $user->amount. 'NGN Has beeen credited to your wallet');
            
        }
    }
}
