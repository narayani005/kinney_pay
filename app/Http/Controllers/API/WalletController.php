<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Wallet;
use App\Models\User;
use App\Models\AddAccount;
use App\Models\Rewards;

use Illuminate\Support\Facades\DB;
use Validator;
use Carbon\Carbon;

class WalletController extends Controller
{
 
        function transaction(Request $request){
            try{

                $rules = array(
                    'trans_to_id' => 'required',
                    'trans_to_name' => 'required',
                    'score' => 'required',
                    'trans_by_id' => 'required',
                    'trans_by_name' => 'required',
                    'trans_type' => 'required',
                    'unique_id' => 'required',
                    'uid' => 'required'
                    );
                    $validator = Validator::make($request->all(), $rules);
                    if ($validator->fails()) {
                    $messages = $validator->messages();
                    $result['status'] = 0;
                    $result['message'] = $messages;
                    return response()->json($result);
                    }
                                    
                $data = $request->all();
                $avail_bal = 0;
                $uid = 0;
                $user = '';
                if($request->trans_type == "kinney_vpo"){
                    
                    $acc = AddAccount::where('unique_id', $request->unique_id)->first();
                    $uid = $acc->uid;

                    if($acc){

                        $user_check = \DB::connection('kinney_vpo')->table("sb_end_users")
                        ->where('id', $acc->acc_id)
                        ->first();

                        if(!empty($user_check->userID)){
                            
                            $user = \DB::connection('kinney_vpo')->table("sb_user_wallet")
                                ->where('uw_user_id', $user_check->userID)->first();
                            
                            if($user->uw_amount > 0 && !empty($user->uw_amount)){
                                $avail_bal = $user->uw_amount;
                                
                            }else{
                                $result = [
                                    "status"  => 0,
                                    "message" => "Wallet amount not found "
                                ]; 
                            }

                       }else{
                           $result = [
                               "status"  => 0,
                               "message" => "User Not found "
                           ]; 
                       }

                        
                        

                    }else{
                        $result = [
                            "status"  => 0,
                            "message" => "Please , Add kinney vpo account with kinney pay "
                        ];
                    }
                }elseif($request->trans_type == "kinney_plus"){
                    
                    $acc = AddAccount::where('unique_id', $request->unique_id)->first();
                    $uid = $acc->uid;

                    if($acc){

                        $user_check = \DB::connection('kinney_plus')->table("sb_end_users")
                        ->where('id', $acc->acc_id)
                        ->first();

                        if(!empty($user_check->userID)){
                            
                            $user = \DB::connection('kinney_plus')->table("sb_user_wallet")
                                ->where('uw_user_id', $user_check->userID)->first();
                            
                            if($user->uw_amount > 0 && !empty($user->uw_amount)){

                                $avail_bal = $user->uw_amount;
                                //print_r($avail_bal);die();
                                
                            }else{
                                $result = [
                                    "status"  => 0,
                                    "message" => "Wallet amount not found "
                                ]; 
                            }

                       }else{
                           $result = [
                               "status"  => 0,
                               "message" => "User Not found "
                           ]; 
                       }

                    }else{
                        $result = [
                            "status"  => 0,
                            "message" => "Please , Add kinney vpo account with kinney pay "
                        ];
                    }
                }elseif($request->trans_type == "kinney_pay"){
                    
                    $user = User::find($request->trans_by_id);
                   
                    $uid = $user->uid;
                    if($user){
                        $avail_bal = $user->total_amt;
                        /*$result = [
                            "status"  => 1,
                            "message" => "Accoun verified "
                        ];
                        */
                    }else{
                        $result = [
                            "status"  => 0,
                            "message" => "You Dont Have Account "
                        ];
                    }

                }else{
                    $result = [
                        "status"  => 0,
                        "message" => "Please , Add kinney vpo account with kinney pay "
                    ];
                }
                

                if(!empty($user)){
                if($uid == $request->uid){
                    $trans_to_res = false;
                    $trans_by_res = false;
                         
                    if($request->score <= $avail_bal){
                        

                            if($request->trans_type == "kinney_vpo"){
                                
                                $trans_by = \DB::connection('kinney_vpo')->table("sb_user_wallet")
                                ->where('uw_user_id', $request->unique_id)
                                ->first();

                               if($trans_by->uw_amount > 0 && !empty($trans_by->uw_amount)){

                                $debit = $trans_by->uw_amount - $request->score;

                                $trans_by_res = \DB::connection('kinney_vpo')->table("sb_user_wallet")
                                ->where('uw_user_id', $request->unique_id)->update(['uw_amount' => $debit]);

                               }else{
                                $result = [
                                    "status"  => 0,
                                    "message" => " Wallet Not Found "
                                ];
                               }
                                

                            }elseif($request->trans_type == "kinney_plus"){

                                $trans_by = \DB::connection('kinney_plus')->table("sb_user_wallet")
                                ->where('uw_user_id', $request->unique_id)
                                ->first();
                                
                               
                               if($trans_by->uw_amount > 0 && !empty($trans_by->uw_amount)){
                                
                                $debit = $trans_by->uw_amount - $request->score;

                                $trans_by_res = \DB::connection('kinney_plus')->table("sb_user_wallet")
                                ->where('uw_user_id', $request->unique_id)->update(['uw_amount' => $debit]);

                               }else{
                                $result = [
                                    "status"  => 0,
                                    "message" => " Wallet Not Found "
                                ];
                               }

                            }elseif($request->trans_type == "kinney_pay"){

                                $trans_by = User::find($request->trans_by_id);
                                $debit = $trans_by->total_amt - $request->score;
                                $trans_by->total_amt = $debit;
                                $trans_by_res = $trans_by->update();

                            }else{
                                return  $result = [
                                    "status"  => 0,
                                    "message" => "Transaction failed"
                                ];
                            }

                        if($trans_by_res){

                            $trans_to = User::find($request->trans_to_id);
                            $credit = $trans_to->total_amt + $request->score;
                            $trans_to->total_amt = $credit;
                            $trans_to_res = $trans_to->update();

                                if($trans_to_res){
                                    
                                    $status = 'Success';
                                    return $this->wallet_transaction($data,$status);
                                    
                                    
                                }else{
                                    $status = 'Failed';
                                    return $this->wallet_transaction($data,$status);
                                }

                            }else{
                                $status = 'Failed';
                                return $this->wallet_transaction($data,$status);
                            }

                
                    }else{
                        $result = [
                            "status"  => 0,
                            "message" => "You don't have valid amount to transfer.. "
                        ];
                    }
                }else{
                    $result = [
                        "status"  => 0,
                        "message" => "Wrong pin number"
                    ];
                }
            }else{
                $result = [
                    "status"  => 0,
                    "message" => "User Not Found"
                ];
            }
        }catch (\Exception $e) { 

            $result['status']  = 0;
            $result['message'] = 'Oops!! Unable to process your request. Please check the data and try again.';
            //throw new HttpException(500, $e->getMessage());
            
        } 
            
            return response()->json($result, 200);
            
        }
        public function wallet_transaction($request,$status){
            
           // print_r($request['trans_to_id']);die();
            function generateTransNumber() {
                $number = mt_rand(100000000000, 999999999999); // better than rand()
           
                // call the same function if the barcode exists already
                if (transcodeNumberExists($number)) {
                    return generateTransNumber();
                }
                // otherwise, it's valid and can be used
                return $number;
            }
            //check existing trans id
            function transcodeNumberExists($number) {
                // query the database and return a boolean
                // for instance, it might look like this in Laravel
                return Wallet::where('trans_id',$number)->exists();
            }

            $wallet = new Wallet();
            
            $wallet->trans_to_id = $request['trans_to_id'];
            $wallet->trans_to_name = $request['trans_to_name'];
            $wallet->score = $request['score'];
            $wallet->trans_by_id = $request['trans_by_id'];
            $wallet->trans_id = generateTransNumber();
           // $wallet->trans_id = '55655';
            $wallet->trans_by_name = $request['trans_by_name'];
            $wallet->trans_type = $request['trans_type'];
            $wallet->remark = $request['remark'];
            $wallet->status = $status;
            $res = $wallet->save();

            if($res){
                $trans_to = $request['trans_to_id'];
                $trans_by = $request['trans_by_id'];
                $rewards = '';

                if($status == 'Success'){
                    $date = Carbon::today()->format('Y-m-d');
                    $reward_check = DB::table('rewards')
                    ->where('trans_to', "=", $trans_to)
                    ->where('trans_by', "=", $trans_by)
                    ->whereDate('created_at', '=', $date)
                    ->first();
                 
                    if(!empty($reward_check->id) && $reward_check->id > 0){
                        $rewards = 'Reward not added';
                    }else{
                        $reward = new Rewards;
                        $reward->trans_to = $trans_to;
                        $reward->trans_by = $trans_by;
                        $reward->reward_amt = '50.00';
                        $reward->save();

                        if($reward){
                            $user = User::find($trans_by);
                            $tot_reward = $user->total_reward + 50.00;
                            $user->total_reward =  $tot_reward;
                            $upd_user = $user->update();
                            $rewards = [
                                'reward_amt' => $reward->reward_amt,
                                'reward_msg' => 'Reward added'
                            ];
                        }else{
                            $rewards = [
                                'reward_msg' => 'Reward Not added'
                            ];
                        }
                    }
                }

                   if($status == 'Success'){
                      return  $result = [
                           "status"  => 1,
                           "reward" => $rewards,
                           "message" => "Transaction success"
                       ];
                   }else{
                       return  $result = [
                           "status"  => 0,
                           "message" => "Transaction failed"
                       ];
                   }
                 
               }else{
                   return $result = [
                       "status"  => 0,
                       "message" => "Transaction failed"
                   ];
               }

            
        }

    function user_wallet($user_id){
        
        try{
          
            $user_wallet = DB::table('wallets as w')
            ->join('users as u1', 'u1.id', '=', 'w.trans_to_id')
            ->join('users as u2', 'u2.id', '=', 'w.trans_by_id')
            ->select('w.wallet_id','w.trans_to_id','w.trans_to_name','u1.mobile as trans_to_mobile','u1.trans_type as trans_to_acc_type', 'w.score as trans_amt','w.trans_by_id', 'w.trans_by_name','u2.mobile as trans_by_mobile', 'w.trans_type as trans_by_acc_type','w.updated_at as trans_on','w.trans_id','w.status','w.remark')
            ->where('w.trans_to_id', '=', $user_id)
            ->orwhere('w.trans_by_id', '=', $user_id)
            ->orderBy('w.created_at', 'DESC')
            ->get();
            //return response()->json($user_wallet, 200);
            if($user_wallet){
                $result = [
                    "status"  => 1,
                    "user_wallet" => $user_wallet,
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


    function fav_wallet($user_id){
        
        try{
          
            /*$fav_wallet = DB::table('wallets as w')
            ->join('users as u1', 'u1.id', '=', 'w.trans_to_id')
            ->join('users as u2', 'u2.id', '=', 'w.trans_by_id')
            ->select('w.wallet_id','w.trans_to_id','w.trans_to_name','u1.mobile as trans_to_mobile','u1.trans_type as trans_to_acc_type', 'w.score as trans_amt','w.trans_by_id', 'w.trans_by_name','u2.mobile as trans_by_mobile', 'w.trans_type as trans_by_acc_type','w.updated_at as trans_on','w.trans_id','w.status','w.remark')->distinct('w.trans_to_id')
            ->where('w.trans_by_id', '=', $user_id)
            ->get();*/
            
            /*$fav_wallet = Wallet::select('trans_to_id', DB::raw('count(trans_to_id) quantity'))
            ->groupBy('trans_to_id')->get();
            */
            

            $fav_wallet = DB::table('wallets as w')->Join('users', 'users.id', '=', 'w.trans_to_id')
            ->selectRaw('users.*, count(w.trans_to_id) as count')
            ->groupBy('w.trans_to_id')
            ->where('w.trans_by_id', '=', $user_id)
            ->havingRaw('count > 5')
            ->get();
            
            /*$fav_wallet = DB::table('wallets as w')
            ->select('w.*', DB::raw('count(*) as total') )
            ->where('w.trans_by_id', '=', $user_id)
            ->groupBy('w.trans_to_id')
            ->get();
            */
           
            /*$fav_wallet = Wallet::selectRaw('count(*) AS cnt, trans_to_id, trans_by_id')
            ->groupBy('trans_to_id')->orderBy('cnt', 'DESC')->limit(5)->get();
            */

            //return response()->json($user_wallet, 200);
            if($fav_wallet){
                $result = [
                    "status"  => 1,
                    "user_wallet" => $fav_wallet,
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


    

    //admin part - now no use for mobile app
    function all_wallet(){
        $wallet = DB::table('wallets')
        ->join('users', 'users.id', '=', 'wallets.user_id')
        ->get();
        return response($wallet, 200);
  }
    function update_wallet(Request $res){
        $wallet = Wallet::find($res->wallet_id);
        $wallet->score = $res->score;
        $wallet->status = $res->status;
        $res = $wallet->update();
        if($res){
            $response = [
                'wallet' => $wallet,
                'message' => 'data updated successfully',
                'status_code' => '200'
            ];
        }else{
            $response = [
                'message' => 'data updation failed',
                'status_code' => '404'
            ];
        }
        return response()->json($response, 200);
    }
    function wallet_trans(Request $res){
        $wallet = new Wallet;
        //$wallet->user_id = $res->user_id;
        //$wallet->admin_id = $res->admin_id;
        //$wallet->admin_name = $res->admin_name;
        $wallet->score = $res->score;
        $wallet->status = $res->status;
        $res = $wallet->save();
        if($res){
            $response = [
                'wallet' => $wallet,
                'message' => 'data saved successfully',
                'status_code' => '200'
            ];
        }else{
            $response = [
                'message' => 'data not saved',
                'status_code' => '404'
            ];
        }
        return response()->json($response, 200);
    }
    function delete_wallet($wallet_id){
        $wallet = Wallet::find($wallet_id);
        $res = $wallet->delete();
        if($res){
            $response = [
                'message' => 'data Deleted successfully',
                'status_code' => '200'
            ];
        }else{
            $response = [
                'message' => 'data not deleted',
                'status_code' => '404'
            ];
        }
        return response()->json($response, 200);
    }


}
