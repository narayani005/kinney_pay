<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Models\Wallet;
use App\Models\User;
use App\Models\AddAccount;
use App\Models\BankAccount;
use App\Models\Rewards;

use Auth;
use Validator;
use Exception;


class UserController extends Controller
{

    function myprofile($id)
    {
       // $id = auth()->user()->id;
        $data = User::find($id);
        $qrcode = DB::table('users')
        ->select('id','name','email', 'mobile', 'country_code', 'profile_img','trans_type','status','total_amt')
        ->where('id', $id)->get();
        //echo $qrcode;die();
        if(Auth()->user()->is_admin == 1){
            return view('admin.profile', ['data' => $data, 'qrcode' => $qrcode]);
        }else{
            return view('user.profile', ['data' => $data, 'qrcode' => $qrcode]);
        }

    }

    function mywallet(){
        $id = auth()->user()->id;

        $data = DB::table('wallets as w')
            ->join('users as u1', 'u1.id', '=', 'w.trans_to_id')
            ->join('users as u2', 'u2.id', '=', 'w.trans_by_id')
            ->select('w.wallet_id','w.trans_to_id','w.trans_to_name','u1.mobile as trans_to_mobile','u1.trans_type as trans_to_acc_type', 'w.score as trans_amt','w.trans_by_id', 'w.trans_by_name','u2.mobile as trans_by_mobile', 'u2.trans_type as trans_by_acc_type','w.updated_at as trans_on','w.trans_id','w.status','w.remark','w.trans_type')
            ->where('w.trans_to_id', '=', $id)
            ->orwhere('w.trans_by_id', '=', $id)
            ->orderBy('w.created_at', 'DESC')
            ->get();

        if(Auth()->user()->is_admin == 1){
            return view('admin.mywallet', ['datas' => $data]);
        }else{
            return view('user.mywallet', ['datas' => $data]);
        }

    }

    function share_wallet_form(){
        $id = Auth()->user()->id;
        $benefi = DB::table('beneficiars')
                ->join('users', 'users.id' , "=", 'beneficiars.benefi_id')
                ->select('beneficiars.id as pid','beneficiars.benefi_name' , 'beneficiars.benefi_id' , 'users.*')
                ->where('beneficiars.user_id' , $id)
                ->get();

        if(Auth()->user()->is_admin == 1){
            return view('admin.share_wallet' , ['datas' => $benefi] );
        }else{
            return view('user.share_wallet' , ['datas' => $benefi] );
        }
    }


    function wallet_trans(Request $request){

        try{
            //echo 'test';die();
            $rules = array(
                'trans_to_id' => 'required',
                'score' => 'required',
                'trans_by_id' => 'required',
                'trans_by_name' => 'required',
                'trans_type' => 'required',
                'mobile' => 'required',
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
                $acc_unique_id = '';
                if($request->trans_type == "kinney_vpo"){

                    $acc = AddAccount::where('mobile', $request->mobile)
                    ->where('acc_type', $request->trans_type)->first();
                    $uid = $acc->uid;
                    $acc_unique_id = $acc->unique_id;
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

                                return redirect('/Share-Wallet')->with('message', 'Wallet Amount Not Found');
                            }

                       }else{

                           return redirect('/Share-Wallet')->with('message', 'User Not Found');
                       }




                    }else{

                        return redirect('/Share-Wallet')->with('message', 'Wallet Not FoundPlease , Add kinney vpo account with kinney pay');
                    }
                }elseif($request->trans_type == "kinney_plus"){

                    $acc = AddAccount::where('mobile', $request->mobile)
                    ->where('acc_type', $request->trans_type)->first();
                    $uid = $acc->uid;
                    $acc_unique_id = $acc->unique_id;

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

                                return redirect('/Share-Wallet')->with('message', 'Walet amount Not Found');
                            }

                       }else{

                           return redirect('/Share-Wallet')->with('message', 'User Not Found');
                       }

                    }else{

                        return redirect('/Share-Wallet')->with('message', 'Please , Add kinney vpo account with kinney pay');
                    }
                }elseif($request->trans_type == "kinney_pay"){

                    $user = User::find($request->trans_by_id);


                    $uid = $user->uid;
                    if($user){
                        $avail_bal = $user->total_amt;
                    }else{

                        return redirect('/Share-Wallet')->with('message', 'You Dont Have Account');
                    }

                }else{

                    return redirect('/Share-Wallet')->with('message', 'Please , Add kinney vpo account with kinney pay');
                }

                    if(!empty($user)){

                    if($uid == $request->uid){
                        $trans_to_res = false;
                        $trans_by_res = false;

                        if($request->score <= $avail_bal){

                            if($request->trans_type == "kinney_vpo"){

                                $trans_by = \DB::connection('kinney_vpo')->table("sb_user_wallet")
                                ->where('uw_user_id', $acc_unique_id)
                                ->first();

                               if($trans_by->uw_amount > 0 && !empty($trans_by->uw_amount)){

                                $debit = $trans_by->uw_amount - $request->score;

                                $trans_by_res = \DB::connection('kinney_vpo')->table("sb_user_wallet")
                                ->where('uw_user_id', $acc_unique_id)->update(['uw_amount' => $debit]);

                               }else{

                                return redirect('/Share-Wallet')->with('message', 'Wallet Not Found');
                               }


                            }elseif($request->trans_type == "kinney_plus"){

                                $trans_by = \DB::connection('kinney_plus')->table("sb_user_wallet")
                                ->where('uw_user_id', $acc_unique_id)
                                ->first();


                               if($trans_by->uw_amount > 0 && !empty($trans_by->uw_amount)){

                                $debit = $trans_by->uw_amount - $request->score;

                                $trans_by_res = \DB::connection('kinney_plus')->table("sb_user_wallet")
                                ->where('uw_user_id', $acc_unique_id)->update(['uw_amount' => $debit]);

                               }else{
                                return redirect('/Share-Wallet')->with('message', 'Wallet Not Found');
                               }

                            }elseif($request->trans_type == "kinney_pay"){

                                $trans_by = User::find($request->trans_by_id);
                                $debit = $trans_by->total_amt - $request->score;
                                $trans_by->total_amt = $debit;
                                $trans_by_res = $trans_by->update();

                            }else{

                                return redirect('/Share-Wallet')->with('message', 'Transaction failed');
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
                            return redirect('/Share-Wallet')->with('message', 'Insufficient balance');
                        }
                    }else{

                        return redirect('/Share-Wallet')->with('message', 'Wrong pin number');

                    }
                }else{
                    return redirect('/login')->with('message', 'Session closed');
                }
            }catch (\Exception $e) {
                return redirect('/Share-Wallet')->with('message', 'Oops!! Unable to process your request. Please check the data and try again.');

                //throw new HttpException(500, $e->getMessage());
                return response()->json($result, 200);

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

         $benefi_id = $request['trans_to_id'];



         $benefi = DB::table('beneficiars')
         ->select('beneficiars.benefi_name')
         ->where('benefi_id', $benefi_id)
         ->first();

         $wallet = new Wallet();

         $wallet->trans_to_id = $request['trans_to_id'];
         $wallet->trans_to_name = $benefi->benefi_name;
         $wallet->score = $request['score'];
         $wallet->trans_by_id = $request['trans_by_id'];
         $wallet->trans_id = generateTransNumber();
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

                    $reward_check = DB::table('rewards')
                    ->where('trans_to', "=", $trans_to)
                    ->where('trans_by', "=", $trans_by)
                    ->first();
                    if(!empty($reward_check->id) && $reward_check->id > 0){
                        return redirect('/mywallet')->with('message', 'Transaction success');
                    }else{
                        $reward = new Rewards;
                        $reward->trans_to = $trans_to;
                        $reward->trans_by = $trans_by;
                        $reward->reward_amt = '1.00';
                        $reward->save();

                        if($reward){
                            $rewards = [
                                'reward_amt' => $reward->reward_amt,
                                'reward_msg' => 'Reward added'
                            ];
                            return redirect('/mywallet')->with('message', 'Transaction success & Reward Added');
                        }else{
                            return redirect('/mywallet')->with('message', 'Transaction success');
                        }
                    }



                }else{
                    return redirect('/Share-Wallet')->with('message', 'Transaction failed');

                }

            }else{
                return redirect('/Share-Wallet')->with('message', 'Transaction failed');
            }


     }


    function edit_profile($id){
        $data = User::find($id);
        if(Auth()->user()->is_admin == 1){
            return view('admin.edit_profile', ['data' => $data] );
        }else{
            return view('user.edit_profile', ['data' => $data] );
        }
    }
    function update_user(Request $res){
        /*
        $this->validate($res, [
            'profile_img' => 'required|image|mimes:jpeg,png,jpg,bmp,gif,svg|max:2048',
         ]);

          if ($res->hasFile('profile_img')) {

            define('UPLOAD_DIR', 'images/profile/');

            $img = $res->profile_img;
            //$id = $request->id;

            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $fileName = uniqid() . '.png';
            $file = UPLOAD_DIR . $fileName;
            $success = file_put_contents($file, $data);

          }
          */
         // define('UPLOAD_DIR', 'images/');

          if($res->profile_img == ''){
            $profileImage = $res->profile_img_hidden;

          }else{
            $img = $res->profile_img;

            $destinationPath = 'images/profile/';
            $profileImage = date('YmdHis') . "." . $img->getClientOriginalExtension();
            $img->move($destinationPath, $profileImage);

            //$img = str_replace('data:image/png;base64,', '', $img);
            //$img = str_replace(' ', '+', $img);
            //$data = base64_decode($img);
            //$file = UPLOAD_DIR . uniqid() . '.png';
            //$fileName = time() . '.png';
            //$file = UPLOAD_DIR . $fileName;
            //$success = file_put_contents($destinationPath, $profileImage);
            //$file_n = $fileName;
          }

        $user = User::find($res->id);
        $user->name = $res->name;
        $user->email = $res->email;
        $user->mobile = $res->mobile;
        $user->country_code = $res->country_code;
        //$user->password = Hash::make($res->password);
        $user->trans_type = $res->trans_type;
        $user->profile_img = $profileImage;
        $user->is_admin = $res->role;
        $user->update();
        return redirect('/Profile/'.$res->id)->with('message', 'Profile updated successfully ');
    }


    /* Add to kinney plus or kinney VPO wallet debit to kinney pay */
    function add_wallet(){
        $data = User::all();
        if(Auth()->user()->is_admin == 1){
            return view('admin.add_wallet', ['datas' => $data]);
        }else{
        return view('user.add_wallet', ['datas' => $data]);

        }
    }


    function creditDebit(Request $request)
    {
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

        if($request->trans_type == "kinney_plus")
        {
            /* Identify Mobile # using it */
            $getUserList = \DB::connection('kinney_plus')->table("sb_end_users")->where('phone', $request->mobile)->first();

            if(!empty($getUserList->userID))
            {
                /* Kinney Plus User Depend on Wallet */
                $prevUserWallet = \DB::connection('kinney_plus')->table("sb_user_wallet")->where('uw_user_id', $getUserList->userID)->first();
                
                if($request->self_account == 'send'){
                    $user = User::where('mobile', $request->self_mobile)->first();
                    /* Check Balance */
                    if($request->score <= $user->total_amt)
                    {
                        /* Credit */
                        $user->total_amt -=  $request->score;
                        $user->save();

                        if($user->save())
                        {
                            /* Transaction Details to Sucess */
                            $wallet =  new Wallet;
                            $wallet->trans_to_name = Auth::user()->name;
                            //$wallet->trans_to_id = $getUserList->userID;
                            $wallet->trans_to_id = Auth::user()->id;
                            $wallet->trans_id = generateTransNumber();
                            $wallet->score = $request->score;
                            $wallet->trans_by_id = Auth::user()->id;
                            $wallet->trans_by_name = $request->self_account;
                            $wallet->trans_type = $request->trans_type;
                            $wallet->remark = $request->remark;
                            $wallet->status = "Debited";
                            $wallet->trans_by_name = Auth::user()->name;
                            $wallet->save();

                            /* Debit */
                            $reduceAmount = $prevUserWallet->uw_amount +=  $request->score;
                            \DB::connection('kinney_plus')->table("sb_user_wallet")->where('uw_user_id', $getUserList->userID)->update(['uw_amount' => $reduceAmount]);

                            //return back()->with('success','Transaction Successfully.');
                            return redirect()->route('home')->with('success','Transaction Successfully.');
                        }
                    }
                    else
                    {
                        /* Transaction Details to Sucess */
                       /* $wallet =  new Wallet;
                        $wallet->trans_to_name = Auth::user()->name;
                        $wallet->trans_to_id = $getUserList->userID;
                        $wallet->trans_id = generateTransNumber();
                        $wallet->score = $request->score;
                        $wallet->trans_by_id = Auth::user()->id;
                        $wallet->trans_by_name = $request->self_account;
                        $wallet->trans_type = $request->trans_type;
                        $wallet->remark = $request->remark;
                        $wallet->status = "Failed";
                        $wallet->trans_by_name = Auth::user()->name;
                        $wallet->save(); */
                        return redirect()->back()->with('Transaction Failed.','Insufficient Balance check with kinney Plus Account');
                    }

                }else{
                     /* Check Balance */
                     if($request->score <= $prevUserWallet->uw_amount)
                     {
                         /* Credit */
                         $user = User::where('mobile', $request->self_mobile)->first();
 
                         $user->total_amt +=  $request->score;
                         $user->save();
 
                         if($user->save())
                         {
                             /* Transaction Details to Sucess */
                             $wallet =  new Wallet;
                             $wallet->trans_to_name = Auth::user()->name;
                             //$wallet->trans_to_id = $getUserList->userID;
                             $wallet->trans_to_id = Auth::user()->id;
                             $wallet->trans_id = generateTransNumber();
                             $wallet->score = $request->score;
                             $wallet->trans_by_id = Auth::user()->id;
                             $wallet->trans_by_name = $request->self_account;
                             $wallet->trans_type = $request->trans_type;
                             $wallet->remark = $request->remark;
                             $wallet->status = "Credited";
                             $wallet->trans_by_name = Auth::user()->name;
                             $wallet->save(); 
 
                             /* Debit */
                             $reduceAmount = $prevUserWallet->uw_amount -=  $request->score;
                             \DB::connection('kinney_plus')->table("sb_user_wallet")->where('uw_user_id', $getUserList->userID)->update(['uw_amount' => $reduceAmount]);
 
                             //return back()->with('success','Transaction Successfully.');
                             return redirect()->route('home')->with('success','Transaction Successfully.');
                         }
                     }
                     else
                     {
                         /* Transaction Details to Sucess */
                        /* $wallet =  new Wallet;
                         $wallet->trans_to_name = Auth::user()->name;
                         $wallet->trans_to_id = $getUserList->userID;
                         $wallet->trans_id = generateTransNumber();
                         $wallet->score = $request->score;
                         $wallet->trans_by_id = Auth::user()->id;
                         $wallet->trans_by_name = $request->self_account;
                         $wallet->trans_type = $request->trans_type;
                         $wallet->remark = $request->remark;
                         $wallet->status = "Failed";
                         $wallet->trans_by_name = Auth::user()->name;
                         $wallet->save(); */
                         return redirect()->back()->with('Transaction Failed.','Insufficient Balance check with kinney Plus Account');
                     }
                }

            }
            else
            {
                return redirect()->back()->with('Unauthorised','Unauthorised');
            }
        }
        elseif($request->trans_type == "kinney_vpo")
        {
            /* Identify Mobile # using it */
            $getUserList = \DB::connection('kinney_vpo')->table("sb_end_users")->where('phone', $request->mobile)->first();

            if(!empty($getUserList->userID))
            {
                /* Kinney Plus User Depend on Wallet */
                $prevUserWallet = \DB::connection('kinney_vpo')->table("sb_user_wallet")->where('uw_user_id', $getUserList->userID)->first();
                
                if($request->self_account == 'send'){
                    $user = User::where('mobile', $request->self_mobile)->first();
                    /* Check Balance */
                    if($request->score <= $user->total_amt)
                    {
                        /* Credit */
                        $user->total_amt -=  $request->score;
                        $user->save();

                        if($user->save())
                        {
                            /* Transaction Details to Sucess */
                            $wallet =  new Wallet;
                            $wallet->trans_to_name = Auth::user()->name;
                            //$wallet->trans_to_id = $getUserList->userID;
                            $wallet->trans_to_id = Auth::user()->id;
                            $wallet->trans_id = generateTransNumber();
                            $wallet->score = $request->score;
                            $wallet->trans_by_id = Auth::user()->id;
                            $wallet->trans_by_name = $request->self_account;
                            $wallet->trans_type = $request->trans_type;
                            $wallet->remark = $request->remark;
                            $wallet->status = "Debited";
                            $wallet->trans_by_name = Auth::user()->name;
                            $wallet->save();

                            /* Debit */
                            $reduceAmount = $prevUserWallet->uw_amount +=  $request->score;
                            \DB::connection('kinney_vpo')->table("sb_user_wallet")->where('uw_user_id', $getUserList->userID)->update(['uw_amount' => $reduceAmount]);

                            //return back()->with('success','Transaction Successfully.');
                            return redirect()->route('home')->with('success','Transaction Successfully.');
                        }
                    }
                    else
                    {
                        /* Transaction Details to Sucess */
                        /*$wallet =  new Wallet;
                        $wallet->trans_to_name = Auth::user()->name;
                        $wallet->trans_to_id = $getUserList->userID;
                        $wallet->trans_id = generateTransNumber();
                        $wallet->score = $request->score;
                        $wallet->trans_by_id = Auth::user()->id;
                        $wallet->trans_by_name = $request->self_account;
                        $wallet->trans_type = $request->trans_type;
                        $wallet->remark = $request->remark;
                        $wallet->status = "Failed";
                        $wallet->trans_by_name = Auth::user()->name;
                        $wallet->save(); */
                        return redirect()->back()->with('Transaction Failed.','Insufficient Balance check with kinney Plus Account');
                    }

                }else{
                     /* Check Balance */
                     if($request->score <= $prevUserWallet->uw_amount)
                     {
                         /* Credit */
                         $user = User::where('mobile', $request->self_mobile)->first();
 
                         $user->total_amt +=  $request->score;
                         $user->save();
 
                         if($user->save())
                         {
                             /* Transaction Details to Sucess */
                             $wallet =  new Wallet;
                             $wallet->trans_to_name = Auth::user()->name;
                             //$wallet->trans_to_id = $getUserList->userID;
                             $wallet->trans_to_id = Auth::user()->id;
                             $wallet->trans_id = generateTransNumber();
                             $wallet->score = $request->score;
                             $wallet->trans_by_id = Auth::user()->id;
                             $wallet->trans_by_name = $request->self_account;
                             $wallet->trans_type = $request->trans_type;
                             $wallet->remark = $request->remark;
                             $wallet->status = "Credited";
                             $wallet->trans_by_name = Auth::user()->name;
                             $wallet->save();
 
                             /* Debit */
                             $reduceAmount = $prevUserWallet->uw_amount -=  $request->score;
                             \DB::connection('kinney_vpo')->table("sb_user_wallet")->where('uw_user_id', $getUserList->userID)->update(['uw_amount' => $reduceAmount]);
 
                             //return back()->with('success','Transaction Successfully.');
                             return redirect()->route('home')->with('success','Transaction Successfully.');
                         }
                     }
                     else
                     {
                         /* Transaction Details to Sucess */
                       /*  $wallet =  new Wallet;
                         $wallet->trans_to_name = Auth::user()->name;
                         $wallet->trans_to_id = $getUserList->userID;
                         $wallet->trans_id = generateTransNumber();
                         $wallet->score = $request->score;
                         $wallet->trans_by_id = Auth::user()->id;
                         $wallet->trans_by_name = $request->self_account;
                         $wallet->trans_type = $request->trans_type;
                         $wallet->remark = $request->remark;
                         $wallet->status = "Failed";
                         $wallet->trans_by_name = Auth::user()->name;
                         $wallet->save(); */
                         return redirect()->back()->with('Transaction Failed.','Insufficient Balance check with kinney Plus Account');
                     }
                }

            }
            else
            {
                return redirect()->back()->with('Unauthorised','Unauthorised');
            }
        }
    }



    function transactionHistory()
    {
        if(Auth()->user()->is_admin == 1){
            return view('admin.transhistory');
        }else{
            return view('user.transhistory');
        }

    }

    /* Process ajax request */
    public function getTransactionHistory(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Wallet::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Wallet::select('count(*) as allcount')->where('trans_to_name', 'like', '%' . $searchValue . '%')->count();

        // Get records, also we have included search filter as well
        $records = Wallet::orderBy($columnName, $columnSortOrder)
            ->where('wallets.wallet_id', 'like', '%' . $searchValue . '%')
            ->orWhere('wallets.trans_to_name', 'like', '%' . $searchValue . '%')
            ->orWhere('wallets.trans_to_id', 'like', '%' . $searchValue . '%')
            ->orWhere('wallets.trans_id', 'like', '%' . $searchValue . '%')
            ->orWhere('wallets.score', 'like', '%' . $searchValue . '%')
            /* ->orWhere('wallets.trans_by_id', 'like', '%' . $searchValue . '%') */
            ->orWhere('wallets.trans_type', 'like', '%' . $searchValue . '%')
            ->orWhere('wallets.trans_by_name', 'like', '%' . $searchValue . '%')
            ->orWhere('wallets.remark', 'like', '%' . $searchValue . '%')
            ->orWhere('wallets.status', 'like', '%' . $searchValue . '%')
            ->orWhere('wallets.created_at', 'like', '%' . $searchValue . '%')
            ->select('wallets.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {

            $data_arr[] = array(
                "wallet_id" => $record->wallet_id,
                "trans_to_name" => $record->trans_to_name,
                "trans_to_id" => $record->trans_to_id,
                "trans_id" => $record->trans_id,
                "score" => $record->score,
                /* "trans_by_id" => $record->trans_by_id, */
                "trans_type" => $record->trans_by_name,
                "trans_by_name" => $record->trans_type,
                "remark" => $record->remark,
                "status" => $record->status,
                "created_at" => $record->created_at,
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        echo json_encode($response);
    }

    /* Add Accounts */

    function createAccount(){

        $id = auth()->user()->id;
        
        $accounts = AddAccount::where('ref_id', $id)->get();

        //$kinneyplusAmt = \DB::connection('kinney_plus')->table("sb_user_wallet")->get();

        //$kinneyvpoAmt = \DB::connection('kinney_vpo')->table("sb_user_wallet")->get();
        return view('user.accounts.create', ['accounts' => $accounts]);

    }

    function storeAccount(Request $request){

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
                $getUserList = \DB::connection('kinney_vpo')->table("sb_end_users")
                ->where('phone', $request->mobile)
                ->orWhere('userID', $request->mobile)
                ->where('password', $request->password)
                ->first();

                 if($getUserList){

                    $unique_id = $getUserList->userID;

                    $exist_check = AddAccount::where('unique_id', $unique_id)->first();

                    if($exist_check){
                        return redirect('/create-account')->with('message', 'Account Already exist ');

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
                        $auser->save();
                        if($auser){
                            return redirect('/create-account')->with('message', 'Account Added Successfully');
                        }else{
                            return redirect('/create-account')->with('message', 'Account Not Added');

                        }
                    }

                 }else{
                    return redirect('/create-account')->with('message', 'Please check your mobile number & password');
                 }



            }elseif($request->trans_type == "kinney_plus"){
                /* Identify Mobile # using it */
                $getUserList = \DB::connection('kinney_plus')->table("sb_end_users")
                ->where('phone', $request->mobile)
                ->orWhere('userID', $request->mobile)
                ->where('password', $request->password)->first();
                if($getUserList){

                    $unique_id = $getUserList->userID;

                    $exist_check = AddAccount::where('unique_id', $unique_id)->first();

                    if($exist_check){
                        return redirect('/create-account')->with('message', 'Account Already exist ');

                    }else{

                        $auser = new AddAccount;
                        $auser->username = $getUserList->userName;
                        $auser->password =  Hash::make($getUserList->password);
                        $auser->email =  $getUserList->email;
                        $auser->country_code =  $getUserList->country_id;
                        $auser->mobile =  $getUserList->phone;
                        $auser->unique_id =  $getUserList->userID;
                        $auser->acc_type =  'kinney_plus';
                        $auser->acc_id =  $getUserList->id;
                        $auser->ref_id =  $request->user_id;
                        $auser->save();
                        if($auser){
                            return redirect('/create-account')->with('message', 'Account Added Successfully');

                        }else{
                            return redirect('/create-account')->with('message', 'Account Not Added');
                        }
                    }

                 }else{
                    return redirect('/create-account')->with('message', 'Please check your mobile number & password');
                 }

            }
        }catch (\Exception $e) {

            return redirect('/create-account')->with('message', 'Oops!! Unable to process your request. Please check the data and try again.');

        }

    }

    function removeAccount($id){

        $account = AddAccount::find($id);
        $res = $account->delete();
        if($res){
            return redirect('/create-account')->with('message', 'Account Deleted Successfully');

        }else{
            return redirect('/create-account')->with('message', 'Account Not Deleted');

        }

    }

    function generate_pin(){
        $id = auth()->user()->id;

        if(Auth()->user()->is_admin == 1){
            return view('admin.generate_pin' );
        }else{
            return view('user.generate_pin' );
        }
    }


    function pin_submit(Request $request){

        $check_pin = User::find($request->user_id);
        if($check_pin->uid == null){
            if($request->gpin === $request->cpin){
                $user = User::find($request->user_id);
                $user->uid = $request->gpin;
                $res = $user->update();
                if($res){
                    return redirect('/generate_pin' )->with('message', 'Pin number generated successfully');
                }else{
                    return redirect('/generate_pin' )->with('message', 'Pin number not generated');
                }

            }else{

                return redirect('/generate_pin' )->with('message', 'Confirm pin not matching with Created pin');
            }
        }else{

            if($request->gpin === $request->cpin){
                $user = User::find($request->user_id);
                $user->uid = $request->gpin;
                $res = $user->update();
                if($res){
                    return redirect('/generate_pin' )->with('message', 'Pin number updated successfully');
                }else{
                    return redirect('/generate_pin' )->with('message', 'Pin number not updated');
                }

            }else{

                return redirect('/generate_pin' )->with('message', 'Confirm pin not matching with Created pin');
            }

        }


    }

    function forget_pin(){
        $id = auth()->user()->id;

        if(Auth()->user()->is_admin == 1){
            return view('admin.forget_pin' );
        }else{
            return view('user.forget_pin' );
        }
    }

    function change_pin(){
        $id = auth()->user()->id;

        if(Auth()->user()->is_admin == 1){
            return view('admin.change_pin' );
        }else{
            return view('user.change_pin' );
        }
    }

    function cpin_submit(Request $request){

        $check_pin = User::find($request->user_id);

        if($check_pin->uid != NULL){
            if($request->opin === $request->npin){

                return redirect('/change_pin' )->with('message', 'Old pin and New pin number is same');

            }else{

                $user = User::find($request->user_id);
                $user->uid = $request->npin;
                $res = $user->update();

                if($res){
                    return redirect('/change_pin' )->with('message', 'Pin number Changed successfully');
                }else{
                    return redirect('/change_pin' )->with('message', 'Pin number not Changed');
                }

            }
        }else{
            return redirect('/generate_pin' )->with('message', 'Need to Generate pin first');
        }

    }

    /* Subcribe Plans */
    function subscribePlans(Request $request)
    {
        return view('user.plans' );
    }

    /* Subcribe rewards */
    function subscribeRewards(Request $request)
    {
        return view('user.rewards' );
    }

    /* Bank Accounts */
    function bank_accounts(Request $request)
    {
        $id = auth()->user()->id;

        $bankAccounts = BankAccount::where('user_id', $id)->get();

        return view('user.accounts.bank_account' , ['bankAccounts' => $bankAccounts]);
    }

    function store_bank_accounts(Request $request)
    {
        $bankAccount = new BankAccount;
        $bankAccount->user_id = $request->user_id;
        $bankAccount->bank_acc_name = $request->bank_acc_name;
        $bankAccount->bank_acc_id =  $request->bank_acc_no;
        $bankAccount->bank_name = $request->bank_name;
        $bankAccount->ifsc_code =  $request->ifsc_code;
        $bankAccount->branch_name =  $request->branch_name;
        $bankAccount->save();

        return redirect('/Bank-Accounts')->with('message', 'Bank Account Added Successfully');
    }

    function destoryBankAccount($id){

        $account = BankAccount::find($id);
        $res = $account->delete();
        if($res){
            return redirect('/Bank-Accounts')->with('message', 'Account Deleted Successfully');

        }else{
            return redirect('/Bank-Accounts')->with('message', 'Account Not Deleted');

        }

    }




}
