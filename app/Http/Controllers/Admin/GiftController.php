<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Giftcard;
use App\Models\Giftcard_detail;
use Illuminate\Support\Facades\Storage;
use DB;

class GiftController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('isadmin');
    }

    public function index(){
        $data = Giftcard::latest()->paginate(10); 
        return view('admin.addgift',[
            'data'=>$data,
        ]);
    }
    public function store(Request $request){
         $request->validate([
            'file'=>'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        if($request->hasfile('file')){
            $filename    = $request->file('file');
            $newfilename = time().'.'.$filename->getClientOriginalExtension();

            $request->file('file')->storeAs('public/images',$newfilename);

           $data =  Giftcard::create([
                'giftcard'=> $request->name,
                'image' =>$newfilename,
            ]);
            return $data;
        }
    }
    public function nameByCardId($id){
        $data = Giftcard::find($id);

        return  $data;
    }
    public function giftCardDetails($id,$name){
         $data= DB::table('giftcard_details')->where('giftcards_id',$id)
            ->join('giftcards', 'giftcard_details.giftcards_id', '=', 'giftcards.id')
            ->select('giftcard_details.*', 'giftcards.*','giftcard_details.id')
            ->get();

        return view("admin.viewgift",[
            'data'=>$data,
            'name'=>$name,
        ]);
    
    }
    public function getGiftCardDetailsById($id){
        $data = Giftcard_detail::find($id);
        return $data;
    }
    public function editGiftCardDetailsById(Request $request, $id){
        $data = Giftcard_detail::find($id);
        $data->card_type = $request->card_type;
        $data->card_country = $request->card_country;

        $data->price =  $request->card_rate;
        $data->buying_min = $request->card_min;
        $data->buying_max = $request->card_max;
        $data->save();

        return $data;
    }

    
    public function storeGiftCardDetails(Request $request){
        $data = new Giftcard_detail;
        $data->giftcards_id = $request->card_id;
        $data->card_type    = $request->card_type;
        $data->card_country = $request->card_country;
        $data->price        = $request->card_rate;
        $data->buying_min   = $request->card_min;  
        $data->buying_max   = $request->card_max; 
        $data->save(); 

        return true;
    }

    public function delete($id){
        $data = Giftcard::find($id);
        $image = $data->image;
        Storage::delete($image);
        $data->delete();

        return true;
    }
          
}
