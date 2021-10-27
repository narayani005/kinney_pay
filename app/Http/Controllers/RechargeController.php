<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Wallet;
use App\Models\User;
use App\Models\Recharge;

class RechargeController extends Controller
{
    public function recharge_form(){
        $data = User::all();
        
        return view('admin.recharge', ['datas' => $data]);
    }
    public function recharge_history(){
        $data = DB::table('recharges as rc')
        ->join('users as u1', 'u1.id', '=', 'rc.user_id')
        ->join('users as u2', 'u2.id', '=', 'rc.admin_id')
        ->select('u1.name as paid_user_name', 'u1.mobile as paid_user_mobile', 'u2.name as admin_name', 'rc.received_amt as recharged_amt', 'rc.received_date as recharged_date', 'rc.received_time as recharged_time', 'rc.remark as remark', 'rc.status as status')
        ->orderBy('rc.created_at', 'DESC')
        ->get();
        return view('admin.recharge_history', ['datas' => $data]);
    }
    public function recharge(Request $req){
        try{
            
            $user = DB::table('users')
            ->where('mobile', $req->mobile)
            ->first();

            if($user){
                $recharge = new Recharge;
                $recharge->user_id = $user->id;
                $recharge->admin_id = $req->admin_id;
                $recharge->received_amt = $req->amount;
                $recharge->remark = $req->remark;
                $recharge->received_date = $req->date;
                $recharge->received_time = $req->time;
                $recharge->status = 'Success';
                $rres = $recharge->save();
                
                if($rres){
                    $data = User::find($user->id);
                    $user_amt = $user->total_amt + $req->amount;
                    $data->total_amt = $user_amt;
                    $ures = $data->update();
                    if($ures){
                        function generateTransNumber() {
                            $number = mt_rand(100000000000, 999999999999); 
                            if (transcodeNumberExists($number)) {
                                return generateTransNumber();
                            }
                            return $number; 
                        }
                        function transcodeNumberExists($number) {
                            return Wallet::where('trans_id',$number)->exists();
                        }

                        $wallet =  new Wallet;
                        $wallet->trans_to_id = $user->id;
                        $wallet->trans_to_name = $user->name;
                        $wallet->trans_by_id = $req->admin_id;
                        $wallet->score = $req->amount;
                        $wallet->trans_type = 'kinney_pay';
                        $wallet->trans_id = generateTransNumber();
                        $wallet->status = 'Success';
                        $wallet->remark = 'Recharged by ' . auth()->user()->name . ' on ' . $req->date .' '. $req->time;
                        $wallet->trans_by_name = auth()->user()->name;
                        $wallet->save();
                        if($wallet){
                            return redirect('admin/recharge_history')->with('message', 'Recharged successfully');
                        }else{
                            return redirect('/admin/recharge_form')->with('message', 'Recharged failed');
                        }
                       // echo $wallet;
                        
                    }else{
                        $rdata = Recharge::find($recharge->id);
                        $rdata->status = 'Failed';
                        $resp = $recharge->update();
                        return redirect('/admin/recharge_form')->with('message', 'Recharged failed');  
                    }

                }else{
                    return redirect('/admin/recharge_form')->with('message', 'Recharged failed');
                }
                
            }else{
                return redirect('/admin/recharge_form')->with('message', 'User Not Found');
            }
            
        }catch (\Exception $e) { 
            return redirect('/admin/recharge_form')->with('message', 'Recharged failed');
        }
        
    }
}
