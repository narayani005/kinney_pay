<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BankAccount;
use Validator;

class BankAccountController extends Controller
{
    
    public function add_bank_acc(Request $request, $user_id){
        try{
            $rules = array(
                'bank_name' => 'required',
                'bank_acc_name'    => 'required',
                'bank_acc_no'  => 'required',
                'branch_name'    => 'required',
                'ifsc_code'    => 'required'
                );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $messages           = $validator->messages();
                $result['status']   = 0;
                $result['message']  = $messages;
        
                return response()->json($result);
            }
            $check = BankAccount::where('bank_acc_id', $request->bank_acc_no)->first();
            if(!$check){
                    $bank_acc = new BankAccount;
                    $bank_acc->user_id = $user_id;
                    $bank_acc->bank_name = $request->bank_name;
                    $bank_acc->bank_acc_name = $request->bank_acc_name;
                    $bank_acc->bank_acc_id = $request->bank_acc_no;
                    $bank_acc->branch_name = $request->branch_name;
                    $bank_acc->ifsc_code = $request->ifsc_code;
                    $res = $bank_acc->save();
                    if($res){
                        $result = [
                            "status" => 1,
                            "data" => "Account Added successfully"
                            ];
                    }else{
                        $result = [
                            "status" => 0,
                            "data" => "Data Not Added"
                            ];
                    }
                }else{
                    $result = [
                        "status" => 0,
                        "data" => "Data Already Exist"
                        ];
                }    
        }catch (\Exception $e) { 
                $result['status']  = 0;
                $result['message'] = 'Oops!! Unable to process your request. Please check the data and try again.';
                //throw new HttpException(500, $e->getMessage());
            }
            return response()->json($result, 200);
    }

    function get_bank_acc($user_id){
        try{
            
            $user_acc = BankAccount::where('user_id', $user_id)->get();
            if($user_acc){
                $result = [
                    "status" => 1,
                    "data" => $user_acc
                    ];
            }else{
                $result = [
                    "status" => 0,
                    "data" => "Data Not Found"
                    ];
            }
        }catch (\Exception $e) { 
            $result['status']  = 0;
            $result['message'] = 'Oops!! Unable to process your request. Please check the data and try again.';
            //throw new HttpException(500, $e->getMessage());
        }
        return response()->json($result, 200);
    }

    function edit_bank_acc(Request $request, $id){
        try{
            $rules = array(
                'bank_name' => 'required',
                'bank_acc_name'    => 'required',
                'bank_acc_no'  => 'required',
                'branch_name'    => 'required',
                'ifsc_code'    => 'required'
                );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $messages           = $validator->messages();
                $result['status']   = 0;
                $result['message']  = $messages;
        
                return response()->json($result);
            }
            $user_acc = BankAccount::find($id);
            if($user_acc){
                    $user_acc->bank_name = $request->bank_name;
                    $user_acc->bank_acc_name = $request->bank_acc_name;
                    $user_acc->bank_acc_id = $request->bank_acc_no;
                    $user_acc->branch_name = $request->branch_name;
                    $user_acc->ifsc_code = $request->ifsc_code;
                    $res = $user_acc->update();
                    if($res){
                        $result = [
                            "status" => 1,
                            "data" => "Account Updated successfully"
                            ];
                    }else{
                        $result = [
                            "status" => 0,
                            "data" => "Data Not Updated"
                            ];
                    }
            }else{
                $result = [
                    "status" => 0,
                    "data" => "Data Not Found"
                    ]; 
            }
    
        }catch (\Exception $e) { 
            $result['status']  = 0;
            $result['message'] = 'Oops!! Unable to process your request. Please check the data and try again.';
            //throw new HttpException(500, $e->getMessage());
        }
        return response()->json($result, 200);
    }


    function del_bank_acc($id){
        try{

            $user_acc = BankAccount::find($id);
            $res = $user_acc->delete();
            if($res){
                $result = [
                    "status" => 1,
                    "data" => "Account Deleted successfully"
                    ];
            }else{
                $result = [
                    "status" => 0,
                    "data" => "Data Not Deleted"
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
