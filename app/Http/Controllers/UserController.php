<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Mail\SendMail;
use App\Mail\loginMail;
use App\Mail\Verified;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware(['guest']);
    }
    public function index(){
           return view('user.login');
    }
    public function indexs(){
        return view('user.register');
    }
   
    public function signUp(Request $request){

        $this->validate($request,[
            'name'     => 'required|string',
            'email'    => 'required|string|unique:users,email',
            'phone'    => 'required|unique:users,phone',
            'password' => 'required',
        ]);
        $user = new User;
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->phone    = $request->phone;
        $user->isadmin  = 0;
        $user->isverified = 'false';
        $user->password = Hash::make($request->password);
        $user->id;
        $user->save();

        DB::table('nairawallets')->insert( // create naira wallet
            ['user_id' => $user->id,'amount'=> 0]
        );

        $name = 'Click the above button to activiated your account to have access to the system';

        // Mail::to($request->email)->queue(new SendMail($user->name));
        Mail::to($request->email)->queue(new Verified($name));


        $request->session()->put('user_id', $user->id);
        $request->session()->put('email', $request->email);

        return response()->json([
            'true'=> $request->session()->get('user_id'),
        ]);
    }
    public function login(Request $request){
        $this->validate($request,[
            'email'    => 'required',
            'password' => 'required',
        ]);
        $email    = $request->email;
        $password = $request->password;

       if(!auth()->attempt(['email'=> $email,'password'=> $password,'isverified'=>'true'])){
             return response()->json(['status'=> 'invalid']);
        }else{
            if(auth()->user()->isadmin == 1){
               return response()->json(['status'=> 'admin_login']);
            }else{
                Mail::to($email)->queue(new loginMail());
               return response()->json(['status'=> 'login']);
            }
        }
    
    }

    public function verified(){ // after successful sign ups and pin creation
        return view('user.verified');
    }

}
