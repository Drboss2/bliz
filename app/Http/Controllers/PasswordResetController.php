<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\Pass;
use Illuminate\Support\Facades\Hash;


class PasswordResetController extends Controller
{
     public function passIndex(){
        return view('user.forget');
    }

    public function sendPassLink(Request $request){
        $email = $request->email;

        $data = User::where("email",$email)->count();

        $msg = array(
            'm'=> $email." Please click on the below button to change your password",
        );

        if($data < 1){
            return 'notfound';
        }else{
            Mail::to($email)->send(new Pass($msg,$email));

            return 'sent';
        }

    }

     public function passIndexChange($email){
        return view('user.changepass',[
            'email'=>$email
        ]);
    }

    public function changePass(Request $request){

        $email = $request->email;

        $real_pass = Hash::make($request->pass);
        $count =  User::where(['email'=> $email])->count();

        if($count < 1){
            return 'not found';
        }else{
            $data = User::where('email',$email)->update(['password'=>$real_pass]);

            return 'true' ;

        }
        
    }

    
}
