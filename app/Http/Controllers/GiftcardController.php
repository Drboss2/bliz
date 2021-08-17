<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Giftcard;
use App\Models\Giftcard_detail;
use App\Models\Trade;
use App\Models\Transactions;
use App\Mail\cardMail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\DB;

class GiftcardController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }
    public function index(){
        $data  =  Giftcard::all();
        return view('user.dashboard.trade.index',[
            'data' => $data,
        ]);
    }
    public function getSingleGiftcard($id,$name){
        $data= DB::table('giftcard_details')->where('giftcards_id',$id)
            ->join('giftcards', 'giftcard_details.giftcards_id', '=', 'giftcards.id')
            ->select('giftcard_details.*', 'giftcards.*','giftcard_details.id')
            ->get();

        return view("user.dashboard.trade.cards",[
            'data'=>$data,
            'name'=>$name,
        ]);
        
    }
    public function getcardDetails($id){
        $data = Giftcard_detail::where(['id'=>$id])->get();
        return $data;
    }

    public function sellCardRequest(Request $request){
        $this->validate($request,[
           'card_name'  => 'required',
           'prices' => 'required',
           'amount'     => 'required',
           'total_price' => 'required',
        ]);

        $request->session()->put('card_name', $request->card_name);
        $request->session()->put('prices', $request->prices);
        $request->session()->put('amount', $request->amount);
        $request->session()->put('total_price', $request->total_price);
        $request->session()->put('card_type',$request->card_type);

        return view("user.dashboard.trade.confirm",[
            'card_name'  =>$request->session()->get('card_name'),
            'card_price' =>$request->session()->get('prices'),
            'card_amount' => $request->session()->get('amount'),
            'total_price' => $request->session()->get('total_price'),
            'card_type'  => $request->session()->get('card_type'),
        ]);

        return view('user.dashboard.trade.confirm');
    }
    public function confirmCardRequest(Request $request){
        $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        if($request->hasfile('img')){
            if($request->session()->has('card_name')){
                if($request->session()->has('card_type')){

                    $card_name      = $request->session()->get('card_name');
                    $card_price     = $request->session()->get('prices');
                    $card_amount    = $request->session()->get('amount');
                    $card_total_price = $request->session()->get('total_price');
                    $card_type     = $request->session()->get('card_type');

                    $filename    = $request->file('img');
                    $newfilename = time().'.'.$filename->getClientOriginalExtension();

                    $request->file('img')->storeAs('public/images',$newfilename);

                    $order_id = random_int(1111111110,9999999999);
                    Trade::create([
                        'user_id'=>auth()->user()->id,
                        'order_id'=>$order_id,
                        'assets_image' =>$newfilename,
                        'assets_name'=>$card_name,
                        'assets_type'=>$card_type,
                        'price'=> $card_price,
                        'denomination'=> $card_amount,
                        'expected_amount'=>$card_total_price,
                        'status'=> 'pending',
                    ]);
                    $data = array(
                        'm'=> auth()->user()->name. ' Your giftcard trade with order id of ' . $order_id. ' Has been successful placed ',
                       );

                    Mail::to(auth()->user()->email)->queue(new cardMail($data));

                    return redirect()->route('user.dashboard')->with('gift_success', 'Your Giftcard order has been placed');
                }
            }
        }  
    }

}
