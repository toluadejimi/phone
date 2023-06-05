<?php

namespace App\Http\Controllers;

use App\Models\ItemLog;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sold;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Mail;
use MercadoPago\Item;

class ProductController extends Controller
{
   

    public function fund_now(request $request){

        $key = env('WEBKEY');
        $ref= "FUD-".random_int(100000, 999999);

        $url = "https://web.enkpay.com/pay?amount=$request->amount&key=$key&ref=$ref";


        $trx= new Transaction();
        $trx->amount = $request->amount;
        $trx->user_id = Auth::id();
        $trx->status = 0;
        $trx->trx_ref = $ref;
        $trx->type = 2;
        $trx->save();


        return Redirect::to($url);

    }

    public function verify_trx(request $request){

     

        $trx_id = $request->trans_id;
        $amount = $request->amount;
        $status = $request->status;

        // dd("hello");

        if($status == 'success'){
            $getx =  Transaction::where('trx_ref', $trx_id)->where('status', 0)->first() ?? null;

            if($getx != null){
    
                User::where('id', Auth::id())->increment('wallet', $amount);
                Transaction::where('trx_ref', $trx_id)->where('status', 0)->update(['status' => 1]);
                return redirect('user/dashboard')->with('message', "Wallet has been funded with $amount");
            }




        }


        if($status == 'failed'){

                return redirect('user/dashboard')->with('error', 'Transaction Declined');
          
        }

        return redirect('user/dashboard')->with('error', 'Transaction Declined');

    }


    

   
   
    public function buyNow(request $request){


        $amount_of_product = $request->qty * $request->amount;

         $usr = User::where('id', Auth::id())->first() ?? null;



         $get_user_Wallet = User::where('id', Auth::id())->first()->wallet;

        if($amount_of_product < $get_user_Wallet){

            return back()->with('error', "Insufficient Balance, Fund your wallet");

        }


        if($amount_of_product < $get_user_Wallet){

            return back()->with('error', "Insufficient Balance, Fund your wallet");

        }




        $pr = ItemLog::where('id', $request->area_code)->first();

        $user_wallet = User::where('id', Auth::id())->first()->wallet;

        $debit = $user_wallet - $request->amount;

        User::where('id', Auth::id())->update(['wallet' => $debit ]);






        $trx = new Transaction();
        $trx->trx_ref = "TRX - ". random_int(1000000, 9999999);
        $trx->user_id = Auth::id();
        $trx->amount = $pr->price;
        $trx->type = 1;
        $trx->status = 1;
        $trx->save();



        $sold = new Sold();
        $sold->user_id = Auth::id();
        $sold->area_code = $pr->area_code;
        $sold->amount = $pr->price;
        $sold->data = $pr->data;
        $sold->save();


        $order = new Order();
        $order->order_id = "TRX - ". random_int(1000000, 9999999);
        $order->user_id = Auth::id();
        $order->amount = $pr->price;
        $order->save();


        ItemLog::where('id', $request->area_code)->delete();



        //send mail
        $data = array(
            'fromsender' => 'noreply@enkpay.com', 'EnkPay',
            'subject' => "LOG Purchase",
            'toreceiver' => Auth::user()->email,
            'logdata' => $pr->data,
            'area_code' => $pr->area_code,
            'name' => Auth::user()->name,



        );


        Mail::send('mails.log', ["data1" => $data], function ($message) use ($data) {
            $message->from($data['fromsender']);
            $message->to($data['toreceiver']);
            $message->subject($data['subject']);
        });



        return back()->with('message', "Log purchase successful");











        $remv = ItemLog::where('id', $request->area_code)->first();

        // product
        // area_code
        // amount
        // qty
      
       






        


    }

        public function areacode(Request $request)
        {
            $data['states'] = ItemLog::where("item_id", $request->item_id)
                                          ->get(["area_code", "id"]);
      
            return response()->json($data);
        }



        
        /**
         * Write code on Method
         *
         * @return response()
         */
        public function amount(Request $request)
        {
            $data['cities'] = ItemLog::where("id", $request->id)
            ->get(["price", "id"]);
                                          
            return response()->json($data);
        }

    // }
}
