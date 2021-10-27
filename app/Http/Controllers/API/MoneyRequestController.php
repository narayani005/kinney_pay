<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\MoneyRequest;
use App\Models\Config;
use Validator;

class MoneyRequestController extends Controller
{
    //
    function req_money(Request $request){
        try{
            $rules = array(
                'req_user_id'    => 'required',
                'req_amt'    => 'required',
                'req_to_acc'    => 'required',
                'acc_unique_id'    => 'required',
                'bank_acc_id' => 'required',
                'country_code' => 'required' 
                );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $messages           = $validator->messages();
                $result['status']   = 0;
                $result['message']  = $messages;
        
                return response()->json($result);
            }
           
                $amt = 0;
                $acc_wallet = '';
                $country_code = $request->country_code;
                if($request->req_to_acc == 'kinney_vpo'){

                    $acc_wallet =  \DB::connection('kinney_vpo')->table("sb_user_wallet")
                    ->where('uw_user_id', $request->acc_unique_id)
                    ->first();
                    
                    $amt = $acc_wallet->uw_amount;

                }elseif($request->req_to_acc == 'kinney_plus'){

                    $acc_wallet =  \DB::connection('kinney_plus')->table("sb_user_wallet")
                    ->where('uw_user_id', $request->acc_unique_id)
                    ->first();
                    
                    $amt = $acc_wallet->uw_amount;
                    
                }elseif($request->req_to_acc == 'kinney_pay'){
                    $acc_wallet =  User::find($request->req_user_id);
                    $amt = $acc_wallet->total_amt;
                }else{
                    $result = [
                        "status" => 0,
                        "Result"=>"Account not found"
                    ];
                }
                 
                if($acc_wallet){
                    
                    $service = Config::where('country_code', $country_code)->first();
                    
                    if($service){

                        $ser_charge = $service->service_charges;
                        $charge = $request->req_amt * ($ser_charge/100);
                        $tot_req_amt = $charge + $request->req_amt;
                        
                        if($tot_req_amt <= $amt){
                        
                            $debit_res = false;

                            if($request->req_to_acc =='kinney_vpo'){

                                $debit_wallet = \DB::connection('kinney_vpo')->table("sb_user_wallet")
                                    ->where('uw_user_id', $request->acc_unique_id)
                                    ->first();
                                if($debit_wallet->uw_amount > 0 && !empty($debit_wallet->uw_amount)){

                                    $debit = $debit_wallet->uw_amount - $request->req_amt;
        
                                    $debit_res = \DB::connection('kinney_vpo')->table("sb_user_wallet")
                                    ->where('uw_user_id', $request->acc_unique_id)->update(['uw_amount' => $debit]);
        
                                }else{
                                    $result = [
                                        "status"  => 0,
                                        "message" => " Wallet Not Found "
                                    ];
                                }
                                
            
                            }elseif($request->req_to_acc == 'kinney_plus'){
                            
                            $debit_wallet = \DB::connection('kinney_plus')->table("sb_user_wallet")
                            ->where('uw_user_id', $request->acc_unique_id)
                            ->first();
                            
                            if($debit_wallet->uw_amount > 0 && !empty($debit_wallet->uw_amount)){

                                $debit = $debit_wallet->uw_amount - $request->req_amt;
                                

                                $debit_res = \DB::connection('kinney_plus')->table("sb_user_wallet")
                                ->where('uw_user_id', $request->acc_unique_id)->update(['uw_amount' => $debit]);

                            }else{
                                $result = [
                                    "status"  => 0,
                                    "message" => " Wallet Not Found "
                                ];
                            }
                                
                            }elseif($request->req_to_acc == 'kinney_pay'){
                                $debit_wallet =  User::find($request->req_user_id);

                                $debit = $debit_wallet->total_amt - $request->req_amt;
                                    $debit_wallet->total_amt = $debit;
                                    $debit_res = $debit_wallet->update();
                                
                            }else{
                                $result = [
                                    "status" => 0,
                                    "Result"=>"Account not found"
                                ];
                            }
                            if($debit_res){    

                                function generateTransNumber() {
                                    $number = mt_rand(100000000000, 999999999999); 

                                    if (transcodeNumberExists($number)) {
                                        return generateTransNumber();
                                    }
                                    return $number;
                                }
                                //check existing trans id
                                function transcodeNumberExists($number) {
                                    return MoneyRequest::where('req_id',$number)->exists();
                                }

                                $req_money = new MoneyRequest;
                                $req_money->req_user_id = $request->req_user_id;
                                $req_money->req_amt = $tot_req_amt;
                                $req_money->bank_acc_id = $request->bank_acc_id;
                                $req_money->req_id = generateTransNumber();
                                $req_money->req_to_acc = $request->req_to_acc;
                                $req_money->acc_unique_id = $request->acc_unique_id;
                                $req_money->status = 'Pending';
                                $res = $req_money->save();
                                if($res){
                                    
                                    $result = [
                                        "status" => 1,
                                        "Result"=>"Request Sent"
                                    ];
                                }else{
                                    $result = [
                                        "status" => 0,
                                        "Result"=>"Request Not Sent"
                                    ];
                                }

                            }else{
                                $result = [
                                    "status" => 0,
                                    "Result"=>"Request Not Sent"
                                ]; 
                            }
                        }else{
                            $result = [
                                "status" => 0,
                                "Result"=>"You dont have valid amount.."
                            ];
                        }
                    }else{
                        $result = [
                            "status" => 0,
                            "Result"=>"Service charge is not updated to this Country code"
                        ];
                    }
                }else{
                    $result = [
                        "status" => 0,
                        "Result"=>"User Wallet not found"
                    ];
                }


        }
            catch (\Exception $e) { 
                $result['status']  = 0;
                $result['message'] = 'Oops!! Unable to process your request. Please check the data and try again.';
                //throw new HttpException(500, $e->getMessage());
            }
            return response()->json($result, 200);
        }


        function req_money_history($user_id){
            try{

                $data = DB::table('money_requests as m')
                ->join('users as u', 'u.id', '=', 'm.req_user_id')
                ->join('bank_accounts as b', 'b.id', '=', 'm.bank_acc_id')  
                ->select('u.name', 'm.req_amt', 'm.created_at', 'm.id', 'm.status','m.req_to_acc','m.acc_unique_id','m.req_id', 'b.bank_acc_name','b.bank_acc_id','b.branch_name','b.ifsc_code','b.bank_name')          
                ->where('req_user_id', $user_id)
                ->orderBy('m.created_at', 'DESC')
                ->get();
                if(!empty($data)){
                    $result = [
                        "status" => 1,
                        "req_history" => $data,
                        "Result"=>"User found"
                    ];
                }else{
                    $result = [
                        "status" => 0,
                        "Result"=>"User not found"
                    ];
                }
                
            }
            catch (\Exception $e) { 
                $result['status']  = 0;
                $result['message'] = 'Oops!! Unable to process your request. Please check the data and try again.';
                //throw new HttpException(500, $e->getMessage());
            }
            return response()->json($result, 200);
        }





}
