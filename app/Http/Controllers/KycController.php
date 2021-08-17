<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kyc;

class KycController extends Controller

{
    public function __construct(){
        $this->middleware(['auth']);
    }
    public function index(){
        $d = Kyc::all();
        return view('user.dashboard.kyc.index',[
            'data'=> $d,
        ]);
    }

    public function create(Request $request){
        $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'phone'      => 'required',
            'state'       => 'required',
            'gender'      => 'required',
            'front_file'  => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'back_file'   => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',

        ]);
        $data = new Kyc;
        $data->user_id    = auth()->user()->id;
        $data->first_name = $request->first_name;
        $data->last_name  = $request->last_name;
        $data->phone      = $request->phone;
        $data->state      = $request->state;
        $data->gender     = $request->gender;
        $file1            = $request->file('front_file');
        $file2            = $request->file('back_file');
    
        $data->front_file  = time().'.'.$file1->getClientOriginalExtension();

        $data->back_file   = '12'.time().'.'.$file2->getClientOriginalExtension();

        $file1->storeAS('public/images',$data->front_file);
        $file2->storeAS('public/images',$data->front_file);

        $data->status      = 'pending';

        $data->save();

        return 'save';

    }
}
