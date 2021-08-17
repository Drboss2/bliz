<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pin;
use App\Models\User;
use App\Mail\Verified;
use Illuminate\Support\Facades\Mail;

class PinController extends Controller
{
    public function index(){
        return view('user.pin');
    }
    public function createPin(Request $request){
        if($request->session()->has('user_id')) {
                $user_id =  $request->session()->get('user_id');
            if(Pin::where('user_id',$user_id)->exists()){
                return 'pin already created';
            }else{
                $pin = new Pin;
                $pin->user_id = $user_id;
                $pin->pin     = $request->pin;
                $pin->save();

               // Mail::to($request->session()->get('email'))->queue(new Verified());
                
                return true;
            }
        }else{
            return "session expired";
        }
       
    }

    public function verifyUsers(Request $request){
        if($request->session()->has('user_id')) {
            $user_id =  $request->session()->get('user_id');
            User::where('id',$user_id)->update(['isverified'=> 'true']);

            return view('user.isverifed');
        }
    }

    public function resendMail(Request $request){
        $name = 'Click the above button to activiated your account to have access to the system';
        
        Mail::to($request->session()->get('email'))->queue(new Verified($name));

        return 'sent';
    }

}
