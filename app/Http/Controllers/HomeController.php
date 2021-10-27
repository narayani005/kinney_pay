<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Beneficiar;
use App\Models\Wallet;
use App\Models\MoneyRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    function test(){
        return view('welcome');
    }
    public function index()
    {
        $id = auth()->user()->id;
        $data = User::find($id);  

        if(auth()->user()->is_admin == 1){
            $users = User::all()->count();
            $wallet = Wallet::all()->count();
            $money_req = MoneyRequest::all()->count();
            //$wallet = Wallet::select(DB::raw('sum(score) as total'))->get();
            return view('admin.dashboard',['data' => $data, 'users' => $users, 'wallet' => $wallet, 'money_req' => $money_req]);

        }else{
            $benefi = Beneficiar::where('user_id', $id)->count();
            $trans_to = DB::table('wallets')->select('score as trans_to_amt')->where('trans_to_id' , $id)->get();
            $trans_by = DB::table('wallets')->select('score as trans_by_amt')->where('trans_by_id' , $id)->get();

            if($trans_by->isEmpty()){
                $trans_by = "0";
            }else {
                $obj_by = json_decode($trans_by, true);
                $trans_by = $obj_by[0]['trans_by_amt'];
            }

            if($trans_to->isEmpty()){
                $trans_to = "0";
            }else {
                $obj_to = json_decode($trans_to, true);
                $trans_to = $obj_to[0]['trans_to_amt'];
            }

            return view('user.dashboard',['data' => $data , 'benefi' => $benefi, 'trans_to_amt' => $trans_to, 'trans_by_amt' => $trans_by]);
        }

    }

    public function adminHome()
    {
        $id = auth()->user()->id;
        $data = User::find($id);
        $users = User::all()->count();
        $wallet = Wallet::all()->count();
        $money_req = MoneyRequest::all()->count();
        //$wallet = Wallet::select(DB::raw('sum(score) as total'))->get();
        return view('admin.dashboard',['data' => $data, 'users' => $users, 'wallet' => $wallet ,'money_req' => $money_req]);
    }

    public function newlogin()
    {
        return view('layouts.master');
    }
    
}
