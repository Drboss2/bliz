<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cryptoasset;
use App\Models\Crypto_detail;
use Illuminate\Support\Facades\DB;


class CryptoassetsController extends Controller
{
     public function __construct(){
        $this->middleware(['auth']);
    }

    public function index(){
        $data = Cryptoasset::latest()->paginate(4); 
        return view('admin.addcrypto',[
            'data'=>$data,
        ]);
    }
   
    public function store(Request $request){

        $this->validate($request,[
            'assets'=>'required',
            'address'=>'required',
            'file'=>'required|image|mimes:jpeg,png,jpg,svg|max:2048',

        ]);
        $filename    = $request->file('file');
        $newfilename = time().'.'.$filename->getClientOriginalExtension();

        $request->file('file')->storeAs('public/images',$newfilename);

        $data = new Cryptoasset;
        $data->assets  = $request->assets;
        $data->address = $request->address;
        $data->image   = $newfilename;

        $data->save();

        return $data;
    }
    public function delete($id){
        $data = Cryptoasset::find($id);
        $data->delete();
        return true;
    }

    public function storeCryptoDetails(Request $request){
        $this->validate($request,[
            'crypto_name'=>'required',
            'rate'=>'required',
            'min'=>'required',
            'max'=>'required',
        ]);

        $data = new Crypto_detail;
        $data->cryptoassets_id = $request->id;
        $data->crypto_name     = $request->crypto_name;
        $data->rate            =$request->rate;
        $data->min             = $request->min;
        $data->max             = $request->max;
        $data->save();

        return 'true';

    }

    public function cryptoCardDetails($id,$name){
         $data= DB::table('crypto_details')->where('cryptoassets_id',$id)->get();

        return view("admin.viewcrypto",[
            'data'=>$data,
            'name'=>$name,
        ]);
    
    }
    public function getCryptoDetailsById($id){
        $data = Crypto_detail::where('id',$id)->get();

        return $data;
    }
    public function deleteCrypto(Request $request){
        $data = Crypto_detail::find($request->id);
        $data->delete();

        return 'delete';
    }

    public function editCryptoDetailsById(Request $request){
        $data = Crypto_detail::find($request->id);
        $data->crypto_name = $request->crypto_name;
        $data->min         = $request->min;
        $data->max         = $request->max;
        $data->rate        = $request->rate;
        $data->save();

        return $data;
    }

    public function getAdress($id){
        $data = Cryptoasset::find($id);
        return $data->address;
    }

     public function editAdress(Request $request){
        $data = Cryptoasset::find($request->addrid);
        $data->address =  $request->ad;
        $data->save();

        return $data->address;
    }



}
