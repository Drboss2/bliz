<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Trade;
use App\Models\Subscribe;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{
    public function index(){
       $user = User::all()->count();
       $trade = Trade::all()->count();

       return view('user.index',[
           'user'=> $user,
           'trade'=>$trade
       ]);
    }

    public function Contact(Request $request){
       $name    = $request->name;
       $email   = $request->p_email;  
       $subject = $request->$subject;
       $message = $request->message;
       
       Mail::send('Html.view', $data, function ($message) {
           $message->from('john@johndoe.com', 'John Doe');
           $message->sender('john@johndoe.com', 'John Doe');
           $message->to('john@johndoe.com', 'John Doe');;
           $message->replyTo('john@johndoe.com', 'John Doe');
           $message->subject('Subject');
          
       });
    }

    public function newsLetters(Request $request){ // store subscribers in db
        $this->validate($request,[
            'email'    => 'required|string|unique:subscribes,email',
        ]);

       $sub = new Subscribe;
       $sub->email = $request->email;
       $sub->save();

       return "sent";
    }

}
