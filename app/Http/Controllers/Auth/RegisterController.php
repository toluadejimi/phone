<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Str;
use Auth;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
  

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(request $request)
    {

        $em = User::where('email', $request->email)->first()->email ?? null;

        if($em == $request->email){
            return back()->with('error', 'Email has been taken');
        }


        $name = $request->name;
        $bank_name = "PROVIDUS BANK";
        $cc = create_v_account($name);
        $status = $cc[0]['status'] ?? null;

        if($status == true){

            $usr = new User();
            $usr->name = $name;
            $usr->email = $request->email;
            $usr->password = Hash::make($request->password);
            $usr->bank_name = $bank_name;
            $usr->account_name = $cc[0]['account_name'] ?? null;
            $usr->account_number = $cc[0]['account_no'] ?? null;
            $usr->save();


            return redirect('/login')->with('message', 'Account has been created Successfully');

        }

        $message = "Error Creating VIRTUAL Account on IBDLOADED";

        send_notification($message);


     
    }


    public function generateAuthKey()
    {
        $rend = Str::random(50);
        $check = User::where('authkey', $rend)->first();

        if($check == true){
            $rend = $this->generateAuthKey();
        }
        return $rend;
    }

}
