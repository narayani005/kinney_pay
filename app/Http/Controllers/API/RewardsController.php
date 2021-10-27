<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Rewards;

class RewardsController extends Controller
{
    function get_rewards($user_id){
            try{ 
                $user_rewards = DB::table('rewards as w')
                ->join('users as u1', 'u1.id', '=', 'w.trans_to')
                ->join('users as u2', 'u2.id', '=', 'w.trans_by')
                ->select('w.*')
                ->where('w.trans_by', '=', $user_id)
                ->orderBy('w.created_at', 'DESC')
                ->get();
                if($user_rewards){
                    $result = [
                        "status"  => 1,
                        "user_reward" => $user_rewards,
                        "message" => "Success"
                    ];
                }else{
                    $result = [
                        "status"  => 0,
                        "message" => "Failure"
                    ];
                }

        }catch (\Exception $e) { 

            $result['status']  = 0;
            $result['message'] = 'Oops!! Unable to process your request. Please check the data and try again.';
            //throw new HttpException(500, $e->getMessage());
            
        }
    
        return response()->json($result, 200);
    }


    function total_reward($user_id){
        try{
            $reward_amt = Rewards::where('trans_by', $user_id)->sum('reward_amt');
            if($reward_amt){
                $result = [
                    "status"  => 1,
                    "total_reward_amt" => $reward_amt,
                    "message" => "Success"
                ];
            }else{
                $result = [
                    "status"  => 0,
                    "message" => "Wallet is empty"
                ];
            }
        }catch (\Exception $e) { 

            $result['status']  = 0;
            $result['message'] = 'Oops!! Unable to process your request. Please check the data and try again.';
            //throw new HttpException(500, $e->getMessage());
            
        }

        return response()->json($result, 200);

    }
    
}
