<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bank;

class BankController extends Controller
{
     public function __construct(){
        $this->middleware('auth');
        $this->middleware('isadmin');
    }

    public function index(){
        $data = Bank::latest()->paginate(10); 
        return view('admin.addbank',[
            'data'=>$data,
        ]);
    }
    public function store(Request $request){
        $this->validate($request,[
            'bank_name'=>'required',
        ]);
        $data = new Bank;
        $data->bank_name  = $request->bank_name;
        $data->save();

        return true;
    }
    public function delete($id){
        $data = Bank::find($id);
        $data->delete();
        return true;
    }

}
