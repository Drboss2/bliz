<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kyc;

class KycaController extends Controller
{
    public function __construct(){
        $this->middleware(['auth','isadmin']);
    }

    public function index(){   
        $data  = Kyc::where('status','pending')->latest()->paginate(10);

        return view('admin.viewkyc',[
            'data'=> $data
        ]);
    }
    public function approvekyc(Request $request){
        $data  = Kyc::find($request->id);
        $data->status = 'success';
        $data->save();
        
        return 'success';

    }
    public function removekyc(Request $request){
        $data  = Kyc::find($request->id);
        $data->delete();
        return 'success';

    }
    public function getApprovedKyc(){
        $data  = Kyc::where('status','success')->latest()->paginate(10);
        return view('admin.approvedkyc',[
            'data'=> $data,
        ]);
    }
}
