<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\AddAccount;

use Validator;

class AddAccountController extends Controller
{
    function add_account(Request $request){
        try {

            $rules = array(
                'user_id' => 'required',
                'mobile'    => 'required',
                'trans_type'  => 'required',
                'password'    => 'required'
                );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $messages           = $validator->messages();
                $result['status']   = 0;
                $result['message']  = $messages;
        
                return response()->json($result);
            }

            if($request->trans_type == "kinney_vpo"){
                /* Identify Mobile # using it */

                $mob_check = \DB::connection('kinney_vpo')->table("sb_end_users")
                ->where('phone', $request->mobile)
                ->first();
                if($mob_check){
                $getUserList = \DB::connection('kinney_vpo')->table("sb_end_users")
                ->where('phone', $request->mobile)
                ->where('password', $request->password)
                ->first();
                 if($getUserList){

                    $unique_id = $getUserList->userID;

                    $exist_check = AddAccount::where('unique_id', $unique_id)->first();

                    if($exist_check){
                        $result['status']  = 0;
                        $result['message']  = "Account Already exist";

                    }else{

                        $auser = new AddAccount;
                        $auser->username = $getUserList->userName;
                        $auser->password =  Hash::make($getUserList->password);
                        $auser->email =  $getUserList->email;
                        $auser->country_code =  $getUserList->country_id;
                        $auser->mobile =  $getUserList->phone;
                        $auser->unique_id =  $getUserList->userID;
                        $auser->acc_type =  'kinney_vpo';
                        $auser->acc_id =  $getUserList->id;
                        $auser->ref_id =  $request->user_id;
                        //$auser->status =  "Active";
                        //$auser->uid = "NULL";
                        $auser->save();
                        if($auser){
                            $result['status']  = 1;
                            $result['user']  = $auser;
                            $result['message']  = "Account Added Successfully";
                        }else{
                            $result['status']  = 0;
                            $result['message']  = "Account Not Added";
                        }
                    }

                    
                    
                    
                 }else{
                    $result['status']  = 0;
                    $result['message']  = "Please check your mobile number & password";
                 }
                }else{
                    $result['status']  = 0;
                    $result['message']  = "Mobile Number Not found";  
                }
                

            }elseif($request->trans_type == "kinney_plus"){
                
                $mob_check = \DB::connection('kinney_plus')->table("sb_end_users")
                ->where('phone', $request->mobile)
                ->first();
                if($mob_check){
                    
                /* Identify Mobile # using it */
                $getUserList = \DB::connection('kinney_plus')->table("sb_end_users")
                ->where('phone', $request->mobile)
                ->where('password', $request->password)
                ->first();  
                if($getUserList){

                    $unique_id = $getUserList->userID;
                    
                    $exist_check = AddAccount::where('unique_id', $unique_id)->first();
                    
                    if($exist_check){
                        $result['status']  = 0;
                        $result['message']  = "Account Already exist";

                    }else{
                        
                        $auser = new AddAccount;
                        $auser->username = $getUserList->userName;
                        $auser->password =  Hash::make($getUserList->password);
                        $auser->email =  $getUserList->email;
                        $auser->country_code =  $getUserList->country_id;
                        $auser->mobile =  $getUserList->phone;
                        $auser->unique_id =  $getUserList->userID;
                        $auser->acc_type =  "kinney_plus";
                        $auser->acc_id =  $getUserList->id;
                        $auser->ref_id =  $request->user_id;
                        //$auser->status =  "Active";
                        //$auser->uid = "NULL";
                        $auser->save();
                        if($auser){
                            $result['status']  = 1;
                            $result['user']  = $auser;
                            $result['message']  = "Account Added Successfully";
                        }else{
                            $result['status']  = 0;
                            $result['message']  = "Account Not Added";
                        }
                    }

                    
                    
                    
                 }else{
                    $result['status']  = 0;
                    $result['message']  = "Please check your mobile number & password";
                 }
                }else{
                    $result['status']  = 0;
                    $result['message']  = "Mobile Number Not found";
                }
               

            }


        }catch (\Exception $e) { 
            $result['status']  = 0;
            $result['message'] = 'Oops!! Unable to process your request. Please check the data and try again.';
            //throw new HttpException(500, $e->getMessage());
        }
        return response()->json($result, 200);
    }
    
    function del_account($acc_pid){
        try{
            $get_acc = AddAccount::where('id', $acc_pid)->first();
            $res = $get_acc->delete();
            if($res){
                $result = [
                "status" => 1,
                "data" => "Data deleted successfully"
                ];
            }else{
                $result = [
                "status" => 0,
                "data" => "data not deleted"
                ];
            }
        }catch (\Exception $e) { 
            $result['status'] = 0;
            $result['message'] = 'Oops!! Unable to process your request. Please check the data and try again.';
            //throw new HttpException(500, $e->getMessage());
        }
        return response()->json($result, 200);
    }


    function get_account($id){
        try{
        
            $get_acc = AddAccount::where('ref_id', $id)->get();
            if($get_acc){
                $result['status']  = 1;
                $result['user']  = $get_acc;
                $result['message']  = "Successfully";
            }else{
                $result['status']  = 0;
                $result['message']  = "Account Not found";
            }      
            

        }catch (\Exception $e) { 
            $result['status']  = 0;
            $result['message'] = 'Oops!! Unable to process your request. Please check the data and try again.';
            //throw new HttpException(500, $e->getMessage());
        }
        return response()->json($result, 200);
    }

    function get_acc_amt($unique_id){
        try{
        $get_amt = \DB::connection('kinney_plus')->table("sb_user_wallet")
                ->select('uw_amount')
                ->where('uw_user_id', $unique_id)
                ->first();
            if($get_amt){
                $result['status']  = 1;
                $result['amount']  = $get_amt->uw_amount;
                $result['message']  = "Successfully";
            }else{
                $result['status']  = 0;
                $result['message']  = "Account Not found";
            } 
        }catch (\Exception $e) { 
            $result['status']  = 0;
            $result['message'] = 'Oops!! Unable to process your request. Please check the data and try again.';
            //throw new HttpException(500, $e->getMessage());
        }
        return response()->json($result, 200);                
    }
    function acc_uid_change(Request $request){
        try{
            $rules = array(
                'unique_id'  => 'required',
                'old_pin' => 'required',
                'new_pin' => 'required'
                );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $messages           = $validator->messages();
                $result['status']   = 0;
                $result['message']  = $messages;
        
                return response()->json($result);
            }

            if($request->old_pin != $request->new_pin){
                $acc = AddAccount::where('unique_id', $request->unique_id)->first();
                
                if($acc->uid == $request->old_pin){

                    $acc->uid = $request->new_pin;
                    $uuid = $acc->update();

                    if($uuid){
                        $result['status']   = 1;
                        $result['message']  = 'New Pin Updated Successfully';
                    }else{
                        $result['status']   = 0;
                        $result['message']  = 'Pin not Updated'; 
                    }


                }else{
                    $result['status']   = 0;
                    $result['message']  = 'Old Pin not correct';
                }
            }else{
                $result['status']   = 0;
                $result['message']  = 'Old pin same with new pin';
            }

        }catch (\Exception $e) { 
            $result['status']  = 0;
            $result['message'] = 'Oops!! Unable to process your request. Please check the data and try again.';
            //throw new HttpException(500, $e->getMessage());
        }
        return response()->json($result, 200); 
    }
    function account_status($id, Request $req){
        $user = AddAccount::find($id);
        $user->status = $req->status;
        $res = $user->update();
        if($res){
            return [
                "status" => "success",
                "Result"=>"Status Changed Successfully"
            ];
        }else{
            return [
                "status" => "success",
                "Result"=>"Status Not Changed"
            ];
            
        }
        
    }
    function acc_uid($unique_id){
        try{

            $exist_check = AddAccount::where('unique_id', $unique_id)->first();

            if($exist_check){

                if($exist_check->uid != NULL){
                    $result['status']  = 1;
                    $result['add_detail']  = $exist_check;
                    $result['message']  = "Successfully";
                }else{
                    $result['status']  = 0;
                    $result['message']  = "Uid is empty";
                }   
            }else{
                $result['status']  = 0;
                $result['message']  = "Account Not found";
            }
        }catch (\Exception $e) { 
            $result['status']  = 0;
            $result['message'] = 'Oops!! Unable to process your request. Please check the data and try again.';
            //throw new HttpException(500, $e->getMessage());
        }
        return response()->json($result, 200);


    }



    function acc_uid_create($unique_id, Request $request){
        try{

            $rules = array(
                'acc_uid' => 'required'
                );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $messages           = $validator->messages();
                $result['status']   = 0;
                $result['message']  = $messages;
        
                return response()->json($result);
            }


            $create_uid = AddAccount::where('unique_id', $unique_id)->first();

            if($create_uid){

                if($create_uid->uid == NULL){
                    $create_uid->uid = $request->acc_uid;
                    $res = $create_uid->update();
                    if($res){
                        $result['status']  = 1;
                        $result['message']  = "Pin number created succefully";
                    }else{
                        $result['status']  = 0;
                        $result['message']  = "Pin number not generated";
                    }

                    
                }else{
                    $result['status']  = 0;
                    $result['message']  = "Uid is empty";
                }   
            }else{
                $result['status']  = 0;
                $result['message']  = "Account Not found";
            }
        }catch (\Exception $e) { 
            $result['status']  = 0;
            $result['message'] = 'Oops!! Unable to process your request. Please check the data and try again.';
            //throw new HttpException(500, $e->getMessage());
        }
        return response()->json($result, 200);


    }






}
