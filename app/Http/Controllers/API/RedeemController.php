<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Redeem;
use App\Models\User;

use Validator;

class RedeemController extends Controller
{
    //
    function get_redeem($country_code){
        try{
            $redeem = Redeem::where('country_code', $country_code)->first();

            if($redeem){
                $redeem_arr[] = $redeem->toArray();
                $result = [
                    "status"  => 1,
                    "redeem" => $redeem_arr,
                    "message" => "Success"
                ];
               
            }else{
                $result = [
                    "status"  => 0,
                    "message" => "Failed"
                ]; 
            }
            
        }catch (\Exception $e) { 
                $result['status']  = 0;
                $result['message'] = 'Oops!! Unable to process your request. Please check the data and try again.';
                //throw new HttpException(500, $e->getMessage());
            }
            return response()->json($result, 200);
    }

    function redeem($user_id, Request $request){
        try{
            
            $rules = array(
                'redeem_point'    => 'required'
                );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $messages           = $validator->messages();
                $result['status']   = 0;
                $result['message']  = $messages;
        
                return response()->json($result);
            }

            $user = User::where('id', $user_id)->first();
            if($user){
                $redeem = Redeem::where('country_code', $user->country_code)->first();
                if($redeem){
                    $redeem_pt = $request->redeem_point;
                    $point = $redeem->points;
                    if($redeem_pt >= $point){
                        $tamt = $redeem_pt / $point;
                        $uamt = $user-> total_amt + $tamt;
                        $urwd = $user->total_reward - $request->redeem_point;
                        $user->total_amt = $uamt;
                        $user->total_reward = $urwd;
                        $res = $user->update();
                        if($res){
                            $result = [
                                "status"  => 1,
                                "message" => "Redeem amount Successfully updated"
                            ]; 
                        }else{
                            $result = [
                                "status"  => 0,
                                "message" => "Failed"
                            ]; 
                        }
                    }else{
                        $result = [
                            "status"  => 0,
                            "message" => "Please Check your Redeem Point"
                        ]; 
                    }


                }else{
                    $result = [
                        "status"  => 0,
                        "message" => "Redeem amount not fixed"
                    ];  
                }
            }else{
                $result = [
                    "status"  => 0,
                    "message" => "User Not Found"
                ];  
            }

            
            //$redeem = Redeem::where('country_code', $country_code)->first();
            
        }catch (\Exception $e) { 
                $result['status']  = 0;
                $result['message'] = 'Oops!! Unable to process your request. Please check the data and try again.';
                //throw new HttpException(500, $e->getMessage());
            }
            return response()->json($result, 200);
    }
}
