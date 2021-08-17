<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Pin;


class SettingController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function index(){
        return view('user.dashboard.settings.index');
    }

    public function updateUser(Request $request){
        $user = User::find(auth()->user()->id);
        $user->phone = $request->phone;
        $user->save();

        return response()->json($user);
    }
    public function updatePasword(Request $request){

        $user = User::find(auth()->user()->id);
        
        $user->password = Hash::make($request->new_password);

        $user->save();

        return true;
    }
    public function updatePin(Request $request){
        $user = Pin::where('user_id',auth()->user()->id)->update(['pin'=>$request->new_pin]);
        return true;
    }

}
