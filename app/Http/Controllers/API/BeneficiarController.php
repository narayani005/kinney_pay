<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Beneficiar;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Validator;

class BeneficiarController extends Controller
{
        function add_beneficiar(Request $request){

        try{
            $rules = array(
            'benefi_name' => 'required',
            'mobile' => 'required',
            'user_id' => 'required',
            'add_benefi' => 'required'
            );
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
            $messages = $validator->messages();
            $result['status'] = 0;
            $result['message'] = $messages;
            return response()->json($result);
            }
            
            $user = User::where('mobile', $request->mobile)->first();
            if($user){
                if($request->add_benefi){
                   
                        $check = DB::table('beneficiars')
                        ->where('benefi_id', $user->id)
                        ->where('user_id', $request->user_id)
                        ->first();

                        if(empty($check)){
                            $benefi = new Beneficiar;
                            $benefi->benefi_name = $request->benefi_name;
                            $benefi->user_id = $request->user_id;
                            $benefi->benefi_id = $user->id;
                            $res = $benefi->save();
                            
                            if($res){
                                $result = [
                                "status" => 1,
                                "benefi" =>  $user,
                                "benefi_name" => $request->benefi_name,
                                "message" => "Beneficiary added successfully"
                                ];
                            }else{
                                $result = [
                                "status" => 0,
                                "message" => "Beneficiary Not added"
                                ];
                            }
                        }else{
                            
                            $result = [
                                "status" => 0,
                                "message" => "This user is already in your beneficiary list"
                            ];

                        
                        }

                    
                }else{
                    $result = [
                        "status" => 1,
                        "benefi_name" => $request->benefi_name,
                        "benefi" => $user,
                        "message" => "Beneficiar details"
                        ];
                }
            }else{
                $result = [
                    "status" => 0,
                    "message" => "Mobile Number Not found"
                    ]; 
            }
        
        }catch (\Exception $e) { 
            $result['status'] = 0;
            $result['message'] = 'Oops!! Unable to process your request. Please check the data and try again.';
            //throw new HttpException(500, $e->getMessage());
        }
        return response()->json($result, 200);
        }
        function get_beneficiar($id){
            try{
                //$benefi = Beneficiar::find($id);
                $benefi = DB::table('beneficiars')
                ->join('users', 'users.id' , "=", 'beneficiars.benefi_id')
                ->select('beneficiars.id as pid','beneficiars.benefi_name' , 'users.*')
                ->where('beneficiars.user_id' , $id)
                ->get();

                if($benefi){
                    $result = [
                        "status" => 1,
                        "data" => $benefi
                    ];
                }else{
                    $result = [
                        "status" => 0,
                        "data" => "data not found"
                    ];
                }
            }catch (\Exception $e) { 
                $result['status'] = 0;
                $result['message'] = 'Oops!! Unable to process your request. Please check the data and try again.';
                //throw new HttpException(500, $e->getMessage());
                }
                return response()->json($result, 200);
        }


        function delete_benefi($id){
            try{
            
                $benefi = Beneficiar::find($id);
                
                $res = $benefi->delete();
            
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
       
    }
