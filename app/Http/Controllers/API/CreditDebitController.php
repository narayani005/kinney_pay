<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Models\AddAccount;
use App\Models\Wallet;

use Auth;
use Validator;
use Exception;
use Response;

class CreditDebitController extends BaseController
{
    /* Credit to Kinney Pay Wallet */
    public function creditDebit(Request $request)
    {
        try{
            
            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
                'mobile' => 'required',
                'send_amount' => 'required',
                'trans_type' => 'required',
                'unique_id' => 'required',
                'uid' => 'required'
            ]);
       
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());       
            }

            /*function generateTransNumber() {
                $number = mt_rand(100000000000, 999999999999);
                if (transcodeNumberExists($number)) {
                    return generateTransNumber();
                }
                return $number; 
            }
            function transcodeNumberExists($number) {
                return Wallet::where('trans_id',$number)->exists();
            }
            */
            $uid = 0;
            
            $data = $request->all();
            $acc = AddAccount::where('unique_id', $request->unique_id)->first();
            $uid = $acc->uid;

            if($uid == $request->uid){

            if($request->trans_type == "kinney_vpo")
            {
                /* Identify Mobile # using it */
                $getUserList = \DB::connection('kinney_vpo')->table("sb_end_users")->where('phone', $request->mobile)->first();  
                
                
                if(!empty($getUserList->userID))
                {
                    /* Kinney VPO User Depend on Wallet */
                    $prevUserWallet = \DB::connection('kinney_vpo')->table("sb_user_wallet")->where('uw_user_id', $getUserList->userID)->first();
        
                    /* Check Balance */
                    if($request->send_amount <= $prevUserWallet->uw_amount)
                    {
                        /* Credit */
                        $user = User::find($request->user_id);
                        $credit = $user->total_amt + $request->send_amount;
                        $user->total_amt = $credit;
                        $ures = $user->update();

                        if($ures)
                        {                            
                            /* Debit */
                            $reduceAmount = $prevUserWallet->uw_amount -=  $request->send_amount;
                            \DB::connection('kinney_vpo')->table("sb_user_wallet")->where('uw_user_id', $getUserList->userID)->update(['uw_amount' => $reduceAmount]);
                            
                            $status = 'Success';
                            return $this->wallet_transaction($data,$status);

                            //return $this->sendResponse($user, 'Transaction Successfully.');
                        }
        
                    }
                    else
                    {
                        return $this->sendError('Transaction Failed.', ['error'=>'Insufficient Balance']);
                    }
                
                }else{
        
                    return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
                    
                } 
            }
            elseif($request->trans_type == "kinney_plus")
            {
                /* Identify Mobile # using it */
                $getUserList = \DB::connection('kinney_plus')->table("sb_end_users")->where('phone', $request->mobile)->first();  
                
                if(!empty($getUserList->userID))
                {
                    /* Kinney Plus User Depend on Wallet */
                    $prevUserWallet = \DB::connection('kinney_plus')->table("sb_user_wallet")->where('uw_user_id', $getUserList->userID)->first();
                    
                    /* Check Balance */
                    if($request->send_amount <= $prevUserWallet->uw_amount)
                    {
                        /* Credit */
                        //$user = User::where('mobile', $request->mobile)->first();
                        $user = User::find($request->user_id);
                        $credit = $user->total_amt + $request->send_amount;
                        $user->total_amt = $credit;
                        $ures = $user->update();

                        if($ures)
                        {  
                            /* Debit */
                            $reduceAmount = $prevUserWallet->uw_amount -=  $request->send_amount;
                            
                            \DB::connection('kinney_plus')->table("sb_user_wallet")->where('uw_user_id', $getUserList->userID)->update(['uw_amount' => $reduceAmount]);
                            
                            $status = 'Success';
                            return $this->wallet_transaction($data,$status);
                            //return $this->sendResponse($user, 'Transaction Successfully.');
                        }
                    }
                    else
                    {
                        return $this->sendError('Transaction Failed.', ['error'=>'Insufficient Balance']);
                    }
                
                }else{
        
                    return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
                    
                } 
            }
            else 
            {
                return $this->sendError('Unauthorised.', ['error'=>'Invalid User']);
            }
    
        }else{
            return $this->sendError('Unauthorised.', ['error'=>'Invalid UID']);
        }
        

        }catch (\Exception $e) { 
            $result['status']  = 0;
            $result['message'] = 'Oops!! Unable to process your request. Please check the data and try again.';
            //throw new HttpException(500, $e->getMessage());
            
        }
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

       
         $user_id = $request['user_id'];
         $user = User::find($user_id); 
         $remark = 'self_transaction';
         
         $wallet = new Wallet();
         $wallet->trans_to_id = $request['user_id'];
         $wallet->trans_to_name = $user->name;
         $wallet->score = $request['send_amount'];
         $wallet->trans_by_id = $request['user_id'];
         $wallet->trans_id = generateTransNumber();
        // $wallet->trans_id = '55655';
         $wallet->trans_by_name = $user->name;
         $wallet->trans_type = $request['trans_type'];
         $wallet->remark = $remark;
         $wallet->status = $status;
         $res = $wallet->save();
        
         if($res){
            
                if($status == 'Success'){
                   return  $result = [
                        "status"  => 1,
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


}
