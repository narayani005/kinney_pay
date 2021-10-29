<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Wallet;
use App\Models\User;

class walletController extends Controller
{
    //admin controller 
    function all_user(){
        //$data = User::all();
        $data = DB::table('users')
        ->orderBy('created_at', 'DESC')
        ->get();

        return view('admin.users', ['datas' => $data]);
/*         if(Auth()->user()->is_admin == 0){
            return view('admin.users', ['datas' => $data]);
        }else{
            return redirect()->route('home')->with('message', 'You Dont have access');
        } */
    }
    function all_wallet(){
       
        $user_wallet = DB::table('wallets as w')
            ->join('users as u1', 'u1.id', '=', 'w.trans_to_id')
            ->join('users as u2', 'u2.id', '=', 'w.trans_by_id')
            ->select('w.wallet_id','w.trans_to_id','w.trans_to_name','u1.mobile as trans_to_mobile','u1.trans_type as trans_to_acc_type', 'w.score as trans_amt','w.trans_by_id', 'w.trans_by_name','u2.mobile as trans_by_mobile', 'u2.trans_type as trans_by_acc_type','w.updated_at as trans_on','w.trans_id','w.status','w.remark', 'u1.unique_key as trans_to_key', 'u2.unique_key as trans_by_key','w.trans_type as wallet_trans')
            ->orderBy('w.created_at', 'DESC')
            ->get();
        if(Auth()->user()->is_admin == 1){
            return view('admin.wallet', ['datas' => $user_wallet]);
        }else{
            return redirect()->route('home')->with('message', 'You Dont have access');
        }
        
    }

    function admin_edit_profile($id){
        $data = User::find($id);
        if(Auth()->user()->is_admin == 1){
            return view('admin.admin_edit_profile', ['data' => $data] );
        }else{
            return view('user.edit_profile', ['data' => $data] );
        }
        
    }
    function admin_update_user(Request $res){

        /*$this->validate($res, [
            'profile_img' => 'required|image|mimes:jpeg,png,jpg,bmp,gif,svg|max:2048',
         ]);
         
          if ($res->hasFile('profile_img')) {
            $image = $res->file('profile_img');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/profile/');
            $image->move($destinationPath, $name);
    
          }*/
          define('UPLOAD_DIR', 'images/profile/');
          
        
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
            //$fileName = uniqid() . '.png';
            //$file = UPLOAD_DIR . $fileName;
            //$success = file_put_contents($file, $data);
           // $file_n = $fileName;
          }

        $user = User::find($res->id);
        $user->name = $res->name;
        $user->email = $res->email;
        $user->mobile = $res->mobile;
        $user->country_code = $res->country_code;
        //$user->password = Hash::make($res->password);
        $user->profile_img = $profileImage;
        $user->is_admin = $res->role;
        $user->trans_type = $res->trans_type;
        $user->update();
        //return view('admin.users')->with('message', 'Data updated successfully');
        return redirect('/admin/users')->with('message', 'Data updated successfully');
        //return view('admin.users');
    }
    function add_wallet(){
        $data = User::all();
        return view('admin.add_wallet', ['datas' => $data]);
    }
    function user_submit(Request $res){
        function generateUniqueNumber() {
            $unumber = mt_rand(1000, 9999); // better than rand()
            if (transcodeNumExists($unumber)) {
                return generateUniqueNumber();
            }
           $unique_key = 'KPAY'.''.$unumber;
            return $unique_key;
        }

        function transcodeNumExists($unique_key) {
            return User::where('unique_key',$unique_key)->exists();
        }
        $user = new User;
        $user->name = $res->name;
        $user->email = $res->email;
        $user->mobile = $res->mobile;
        $user->country_code = $res->country_code;
        //$password = Hash::make($res->password);
        $user->password = Hash::make($res->password);
        $user->is_admin = $res->role;
        $user->total_amt = 100;
        $user->trans_type = $res->trans_type;
        $user->unique_key = generateUniqueNumber();
        $user->save();
        return redirect('/admin/users')->with('message', 'User Added Successfully');
    }
    function delete_profile($id){
        $data = User::find($id);
        $data ->delete();
        return redirect('/admin/users');
    }
    function add_wallet_data(Request $res){

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
        $wallet =  new Wallet;
        $wallet->trans_to_id = $res->user_id;
        $wallet->trans_by_id = $res->admin_id;
        $wallet->score = $res->score;
        $wallet->trans_type = $res->type;
        $wallet->trans_id = generateTransNumber();
        $wallet->status = $res->status;
        $wallet->trans_by_name = $res->admin_name;
        $wallet->save();
        return redirect('/admin/wallet')->with('message', 'Data added successfully ');
    }   
    function edit_wallet($id){
        //$data = Wallet::find($id);
        $data = DB::table('wallets')
        ->join('users', 'users.id', "=", 'wallets.user_id')
        ->where('wallets.wallet_id', $id)
        ->first();
        //return $data;
        return view('admin.edit_wallet', ['data' => $data])->with('message', 'Data updated successfully');
    }
     function update_wallet(Request $res){
        
        $wallet = Wallet::where('wallet_id', $res->wallet_id)->first();
        $wallet->score = $res->score;
        $wallet->status = $res->status;
        $wallet->trans_type = $res->trans_type;
        $wallet->update();
        return redirect('/admin/wallet');
    }

    function delete_wallet($id){
        $data = Wallet::find($id);
        $data->delete();
        return redirect('/admin/wallet');
    }




    

}
