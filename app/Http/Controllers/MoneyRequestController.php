<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\AddAccount;
use App\Models\MoneyRequest;
use App\Models\Config;
use App\Models\BankAccount;

use Validator;

class MoneyRequestController extends Controller
{
    function req_money(){
        $id = auth()->user()->id;

        if(Auth()->user()->is_admin == 1){
            return view('admin.req_money');
        }else{
            $bank_acc = BankAccount::where('user_id', $id)->get();
            $bank_count = count($bank_acc);
            return view('user.req_money', ['bank_acc' => $bank_acc, 'bank_count'=>  $bank_count]);
        }
    }

    function req_money_submit(Request $request){
        
        try{
            $rules = array(
                'req_user_id'    => 'required',
                'req_amt'    => 'required',
                'trans_type'    => 'required',
                'mobile'    => 'required' 
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
                $acc_unique_id = '';
                $country_code = 0;
                
                if($request->trans_type == 'kinney_vpo'){

                    $acc = AddAccount::where('mobile', $request->mobile)
                    ->where('acc_type', $request->trans_type)->first();

                    $acc_unique_id = $acc->unique_id;
                    $country_code = $acc->country_code;

                    if($acc){

                            $acc_wallet =  \DB::connection('kinney_vpo')->table("sb_user_wallet")
                            ->where('uw_user_id', $acc_unique_id)
                            ->first();
                            $amt = $acc_wallet->uw_amount;
                        
                    }

                }elseif($request->trans_type == 'kinney_plus'){
                    
                    $acc = AddAccount::where('mobile', $request->mobile)
                    ->where('acc_type', $request->trans_type)->first();
                    
                    $acc_unique_id = $acc->unique_id;
                    
                    $country_code = $acc->country_code;
                    
                    if($acc){
                           
                            $acc_wallet =  \DB::connection('kinney_plus')->table("sb_user_wallet")
                            ->where('uw_user_id', $acc_unique_id)
                            ->first();
                           
                            $amt = $acc_wallet->uw_amount;
                            
                    }

                    
                }elseif($request->trans_type == 'kinney_pay'){

                    $acc_wallet =  User::find($request->req_user_id);
                    
                    $amt = $acc_wallet->total_amt;
                    $country_code = $acc_wallet->country_code;

                }else{
                    
                    return redirect('/req-money')->with('message', 'Amount Not Found');
                }
                 
                if($acc_wallet){

                    $service = Config::where('country_code', $country_code)->first();
                   
                    if($service){

                        $ser_charge = $service->service_charges;
                        $charge = $request->req_amt * ($ser_charge/100);
                        $tot_req_amt = $charge + $request->req_amt;
                        
                        if($tot_req_amt <= $amt){
                            
                            $debit_res = false;

                            if($request->trans_type =='kinney_vpo'){

                                $debit_wallet = \DB::connection('kinney_vpo')->table("sb_user_wallet")
                                    ->where('uw_user_id', $acc_unique_id)
                                    ->first();
                                if($debit_wallet->uw_amount > 0 && !empty($debit_wallet->uw_amount)){

                                    $debit = $debit_wallet->uw_amount - $request->req_amt;
        
                                    $debit_res = \DB::connection('kinney_vpo')->table("sb_user_wallet")
                                    ->where('uw_user_id', $acc_unique_id)
                                    ->where('uw_id', $debit_wallet->uw_id)->update(['uw_amount' => $debit]);
        
                                }else{
                                    
                                    return redirect('/req-money')->with('message', 'Wallet Not Found');
                                }
                                
            
                            }elseif($request->trans_type == 'kinney_plus'){

                            $debit_wallet = \DB::connection('kinney_plus')->table("sb_user_wallet")
                            ->where('uw_user_id', $acc_unique_id)
                            ->first();
                            
                            if($debit_wallet->uw_amount > 0 && !empty($debit_wallet->uw_amount)){

                                $debit = $debit_wallet->uw_amount - $request->req_amt;

                                $debit_res = \DB::connection('kinney_plus')->table("sb_user_wallet")
                                ->where('uw_user_id', $acc_unique_id)
                                ->where('uw_id', $debit_wallet->uw_id)->update(['uw_amount' => $debit]);

                            }else{
                                
                                return redirect('/req-money')->with('message', 'Wallet Not Found');
                            }
                                
                            }elseif($request->trans_type == 'kinney_pay'){
                                
                                $debit_wallet =  User::find($request->req_user_id);

                                $debit = $debit_wallet->total_amt - $request->req_amt;
                                    $debit_wallet->total_amt = $debit;
                                    $debit_res = $debit_wallet->update();
                                
                            }else{
                                
                                return redirect('/req-money')->with('message', 'Account Not Found');
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
                                
                            
                                //generateTransNumber();die();
                                //echo $request->trans_type;die();
                                $req_money = new MoneyRequest;
                                $req_money->req_user_id = $request->req_user_id;
                                $req_money->req_amt = $request->req_amt;
                                $req_money->req_id = generateTransNumber();
                                $req_money->req_to_acc = $request->trans_type;
                                $req_money->acc_unique_id = $acc_unique_id;
                                $req_money->bank_acc_id = $request->bank_acc_id;
                                $req_money->status = "Pending";
                                $res = $req_money->save();
                                //echo $res;die();

                                if($res){
                                
                                return redirect('/req-money-history')->with('message', 'Request Sent');

                                }else{
                                
                                return redirect('/req-money')->with('message', 'Request Not Sent');
                                }

                            }else{
                                
                            return redirect('/req-money')->with('message', 'Request Not Sent'); 
                            }
                        }else{
                            return redirect('/req-money')->with('message', 'You dont have valid amount..');
                        }
                    }else{

                        return redirect('/req-money')->with('message', 'Service charge is not updated to this Country code'); 
                    }
                }else{
                    return redirect('/req-money')->with('message', 'User Wallet not found'); 
                
                }


        }
            catch (\Exception $e) { 
                $result['status']  = 0;
                $result['message'] = 'Oops!! Unable to process your request. Please check the data and try again.';
                //throw new HttpException(500, $e->getMessage());
            }
            return response()->json($result, 200);
        }

    
        function req_money_history(){
            $id = auth()->user()->id;

            if(Auth()->user()->is_admin == 1){
                $data = DB::table('money_requests as m')
                ->join('users as u', 'u.id', '=', 'm.req_user_id') 
                ->select('u.name', 'm.req_amt', 'm.created_at', 'm.id', 'm.status','m.req_id')          
                ->orderBy('m.created_at', 'DESC')
                ->get();
                return view('admin.req_history', ['datas' => $data]);
            }else{
                $data = DB::table('money_requests as m')
                ->join('users as u', 'u.id', '=', 'm.req_user_id')  
                ->select('u.name', 'm.req_amt', 'm.created_at', 'm.id', 'm.status','m.req_id')          
                ->where('req_user_id', $id)
                ->orderBy('m.created_at', 'DESC')
                ->get();
                return view('user.req_history', ['datas' => $data]);
            }
        }

        function withdraw_approval($status, $id){
            $money = MoneyRequest::find($id);
            $money->status = $status;
            $res = $money->update();
            if($res){
                if($status == 'Approved'){
                    return redirect('/admin/req-money-history')->with('message', 'Approved Successfully');  
                }else{
                    return redirect('/admin/req-money-history')->with('message', 'Cancelled Successfully');  
                }
            }else{
                return redirect('/admin/req-money-history')->with('message', 'Approval Failed');  
            }
    
        }


    }

