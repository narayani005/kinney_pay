<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallet;
use App\Models\MoneyRequest;
use Illuminate\Support\Facades\DB;

class PersonalExpenseCotroller extends Controller
{
    function personal_expense($user_id){
        try{

            $tot_wallet_amt = DB::table('wallets')->where('trans_by_id' ,'=', $user_id)->sum('score');
            $user_avail_amt = DB::table('users')->where('id' ,'=', $user_id)->sum('total_amt');
            $withdraw_amt = DB::table('money_requests')->where('id' ,'=', $user_id)->sum('req_amt');
            $tot_amt = $user_avail_amt + $tot_wallet_amt + $withdraw_amt;

            $wallet_perc = ($tot_wallet_amt / $tot_amt) * 100;
            $withdraw_perc = ($withdraw_amt / $tot_amt) * 100;

            $result = [
                "status" => 1,
                "wallet_percentage" => $wallet_perc,
                "withdraw_percentage" => $withdraw_perc,
                "others" => 0,
            ]; 

        }catch (\Exception $e) { 
            $result['status']  = 0;
            $result['message'] = 'Oops!! Unable to process your request. Please check the data and try again.';
            //throw new HttpException(500, $e->getMessage());
        }
        return response()->json($result, 200);

    }
}
