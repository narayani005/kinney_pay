<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BalanceAlert;
use App\Models\User;
use Carbon\Carbon;

class BalanceAlertController extends Controller
{
    //
    function balance_alert($user_id){

        try{
                $date = Carbon::today()->format('Y-m-d');
                $bal_alert = BalanceAlert::where('user_id', $user_id)->first();
                $user_bal = User::find($user_id);

                if($user_bal->total_amt < 500){
                    if($bal_alert && !empty($bal_alert)){
                        $today = strtotime($date);
                        $updated_at = $bal_alert->updated_at->format('Y-m-d');
                        if($updated_at == $date && $bal_alert->status == 1){
                            $result = [
                                "status"  => 0,
                                "message" => "Alert already sent for today"
                            ]; 
                        }else{
                            // print_r($request['trans_to_id']);die();
                            function generateTransNumber() {
                                $number = mt_rand(100000000000, 999999999999); // better than rand()
                        
                                if (transcodeNumberExists($number)) {
                                    return generateTransNumber();
                                }

                                return $number;
                            }
                            //check existing trans id
                            function transcodeNumberExists($number) {
                                return BalanceAlert::where('random',$number)->exists();
                            }
                            $balalert = BalanceAlert::find($bal_alert->id);
                            $balalert->avail_amt = $user_bal->total_amt;
                            $balalert->random = generateTransNumber();
                            $balalert->status = "1";
                            $alert_res = $balalert->update();
                            if($alert_res){
                                $result = [
                                    "status"  => 1,
                                    "message" => "Balance Not Available"
                                ]; 
                            }else{
                                $result = [
                                    "status"  => 0,
                                    "message" => "Alert failed"
                                ]; 
                            }
                        }

                    }else{

                        $save_alert = new BalanceAlert;
                        $save_alert->user_id = $user_id;
                        $save_alert->avail_amt = $user_bal->total_amt;
                        $result = $save_alert->save();
                        if($result){
                     
                            $result = [
                                "status"  => 1,
                                "message" => "Balance Not Available"
                            ]; 
                        }else{
                            $result = [
                                "status"  => 0,
                                "message" => "Alert failed"
                            ]; 
                        } 

                    }
                }else{
                    $result = [
                        "status"  => 0,
                        "message" => "Balance Available"
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
