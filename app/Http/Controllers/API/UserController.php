<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Config;
use Twilio\Rest\Client;

use Auth;
use Image;
use Validator;
use Exception;
use Response;
use QrCode;
use Session;

class UserController extends Controller
{
    function index(Request $request)
    {
        try {

            $rules = array(
                'mobile'    => 'required',
                'country_code' => 'required'
                );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $messages           = $validator->messages();
                $result['status']   = 0;
                $result['message']  = $messages;

                return response()->json($result);
            }

            $user = User::where('mobile', $request->mobile)->first();
            //$token = $user->createToken('mytoken')->plainTextToken;

            if($user){
                $result = [
                    "status" => 1,
                    "Result"=>"Existing User"
                ];

            }else{
                $receiverNumber = '+'.$request->country_code.''.$request->mobile;
                $fourRandomDigit = rand(1000,9999);
                $message = "Kinney Pay OTP to vaildate your mobile number is: $fourRandomDigit";

                try {

                    /* $account_sid = getenv("TWILIO_SID");
                    $auth_token = getenv("TWILIO_TOKEN");
                    $twilio_number = getenv("TWILIO_FROM"); */

                    /* Mahesh account details
                    $account_sid = "AC6eff70616258f2cc34f871ded806479d";
                    $auth_token = "6cfa9fcb226bbf904708609c340ae8ab";
                    $twilio_number = "+18787897593";

                    Narayani account details
                    $account_sid = "ACa543faa1fdfaf5fac5fbb5f2b0360b73";
                    $auth_token = "a5dec2cda122479c3127d6c026a6f9b4";
                    $twilio_number = "+13192507024";

                    */

                    $account_sid = "ACb3fb8b517a0ff1380b7d8823ddf703aa";
                    $auth_token = "829779e1145399781d3a2f6fa743caaf";
                    $twilio_number = "+13185586277";

                    $client = new Client($account_sid, $auth_token);
                    $client->messages->create($receiverNumber, [
                        'from' => $twilio_number,
                        'body' => $message]);

                    //dd('SMS Sent Successfully.');
                    //Session::put('session_otp', $fourRandomDigit);
                    $request->session()->forget('session_otp');
                    $request->session()->put('session_otp',$fourRandomDigit);
                    $result = [
                        "otp" => $fourRandomDigit,
                        "status" => 1,
                        "Result"=>"New User"
                    ];

                } catch (Exception $e) {
                    //dd("Error: ". $e->getMessage());
                    return [
                        "status"=>"Failed",
                        "message"=>"The number  is unverified. Trial accounts cannot send messages to unverified numbers; verify  at twilio.com/user/account/phone-numbers/verified, or purchase a Twilio number to send messages to unverified numbers",
                    ];
                }

            }
        }catch (\Exception $e) {
            $result['status']  = 0;
            $result['message'] = 'Oops!! Unable to process your request. Please check the data and try again.';
            //throw new HttpException(500, $e->getMessage());
        }
        return response()->json($result, 200);
    }

    function resend(Request $request){

        try {
            $rules = array(
                'mobile'    => 'required',
                'country_code' => 'required'
                );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $messages           = $validator->messages();
                $result['status']   = 0;
                $result['message']  = $messages;

                return response()->json($result);
            }
            $user = User::where('mobile', $request->mobile)->first();

            if($user){
                $receiverNumber = '+'.$request->country_code.''.$request->mobile;
                $fourRandomDigit = rand(1000,9999);
                $message = "Kinney Pay OTP to vaildate your mobile number is: $fourRandomDigit";

                try {

                    /* $account_sid = getenv("TWILIO_SID");
                    $auth_token = getenv("TWILIO_TOKEN");
                    $twilio_number = getenv("TWILIO_FROM"); */

                    /* Mahesh account details
                    $account_sid = "AC6eff70616258f2cc34f871ded806479d";
                    $auth_token = "6cfa9fcb226bbf904708609c340ae8ab";
                    $twilio_number = "+18787897593";

                    Narayani account details
                    $account_sid = "ACa543faa1fdfaf5fac5fbb5f2b0360b73";
                    $auth_token = "a5dec2cda122479c3127d6c026a6f9b4";
                    $twilio_number = "+13192507024";

                    */

                    $account_sid = "ACb3fb8b517a0ff1380b7d8823ddf703aa";
                    $auth_token = "829779e1145399781d3a2f6fa743caaf";
                    $twilio_number = "+13185586277";

                    $client = new Client($account_sid, $auth_token);
                    $client->messages->create($receiverNumber, [
                        'from' => $twilio_number,
                        'body' => $message]);

                    //dd('SMS Sent Successfully.');
                    //Session::forget('session_otp');
                    //Session::put('session_otp', $fourRandomDigit);
                    $request->session()->forget('session_otp');
                    $request->session()->put('session_otp',$fourRandomDigit);
                    $result = [
                        "otp" => $fourRandomDigit,
                        "status" => 1,
                        "Result"=>"Existing User"
                    ];

                } catch (Exception $e) {
                    //dd("Error: ". $e->getMessage());
                    return [
                        "status"=>"Failed",
                        "message"=>"The number  is unverified. Trial accounts cannot send messages to unverified numbers; verify  at twilio.com/user/account/phone-numbers/verified, or purchase a Twilio number to send messages to unverified numbers",
                    ];
                }

            }else{
                $result = [
                    'status' => 1,
                    "Result"=>"New User"
                ];

            }
        } catch (\Exception $e) {
            $result['status']  = 0;
            $result['message'] = 'Oops!! Unable to process your request. Please check the data and try again.';
            //throw new HttpException(500, $e->getMessage());
        }
        return response()->json($result, 200);

    }

    function login(Request $request)
    {
        try {

            $rules = array(
                'mobile'    => 'required'
                //'password'    => 'required'
                );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $messages           = $validator->messages();
                $result['status']   = 0;
                $result['message']  = $messages;

                return response()->json($result);
            }

            $user = User::where('mobile', $request->mobile)->first();

            if (empty($user)) {
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
                $user->country_code = $request->country_code;
                $user->mobile = $request->mobile;
                $user->trans_type = "kinney_pay";
                $user->total_amt = 100;
                $user->unique_key = generateUniqueNumber();
                $user->password = Hash::make($request->password);
                $res = $user->save();
                $token = $user->createToken('my-app-token')->plainTextToken;

                /* New User  */
                $result['data']['token'] = $token;
                $result['status']  = 1;
                $result['message'] = 'Created New User Successfully';

            }else if(!empty($request->password) && Hash::check($request->password, $user->password)){
                $token = $user->createToken('my-app-token')->plainTextToken;

                /* Existing User  */
                $result['data']['token'] = $token;
                $result['status']  = 1;
                $result['message'] = 'Already Existing User!';

            }else if(!empty($request->otp) && !empty($request->verify)){
                $token = $user->createToken('my-app-token')->plainTextToken;

                if($request->verify == 'verified'){
                /* OTP Verify  */
                $result['data']['token'] = $token;
                $result['status']  = 1;
                $result['message'] = 'OTP Verified!';
                Session::forget('session_otp');
                }else{
                    /* OTP Mismatch  */
                    $result['data']['token'] = $token;
                    $result['status']  = 0;
                    $result['message'] = 'OTP Not Verified!';
                }

            }else{
                /* Not User */
                $result['data']['token'] = $token;
                $result['status']  = 0;
                $result['message'] = 'User Not Available!';
            }


        } catch (\Exception $e) {
            $result['status']  = 0;
            $result['message'] = 'Oops!! Unable to process your request. Please check the data and try again.';
            //throw new HttpException(500, $e->getMessage());
        }
        return response()->json($result, 200);
    }

    function get_user(){
        try{
            $user = Auth::user();
            $trans = Wallet::where('trans_by_id', $user->id)
            ->orwhere('trans_to_id', $user->id)->get();
            $wallet = 'transaction empty';
            if(!empty($trans)){
                $wallet = 'transaction available';
            }

            if($user){
                $result['status']  = 1;
                $result['user']  = $user;
                $result['wallet'] = $wallet;
                $result['message'] = 'Success';
            }else{
                $result['status']  = 0;
                $result['message'] = 'Failed';
            }
        }
        catch (\Exception $e) {
            $result['status']  = 0;
            $result['message'] = 'Oops!! Unable to process your request. Please check the data and try again.';
            //throw new HttpException(500, $e->getMessage());
        }
        return response()->json($result, 200);
    }

    function change_pwd(Request $request)
    {
        try{
            $rules = array(
                'new_pwd'    => 'required',
                'old_pwd'    => 'required',
                'id'    => 'required'
                );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $messages           = $validator->messages();
                $result['status']   = 0;
                $result['message']  = $messages;

                return response()->json($result);
            }

            $user = User::find($request->id);
            if(Hash::check($request->old_pwd , $user->password)){
                $user->password = Hash::make($request->new_pwd);
                $res = $user->update();
                if($res){

                    $result['status']  = 1;
                    $result['message'] = 'Data has been updated';

                }else{

                    $result['status']  = 0;
                    $result['message'] = 'Data not updated';

                }
            }else{

                $result['status']  = 0;
                $result['message'] = 'Old  password not correct';
            }
        }catch (\Exception $e) {
            $result['status']  = 0;
            $result['message'] = 'Oops!! Unable to process your request. Please check the data and try again.';
            //throw new HttpException(500, $e->getMessage());
        }
        return response()->json($result, 200);

    }
   /* function forget_pwd(Request $res){

        $user = User::where('mobile', $res->mobile);
        $user->password = $user->password;
        $res = $user->update();
        if($res){
            return [
                "status"=>"success",
                "Result"=>"Data has been updated",
            ];
        }else{
            return [
                "status"=>"failed",
                "Result"=>"Data not updated",
            ];
        }

    }
    */
    function update_user(Request $request, $id){
        try{
            $rules = array(
                'name'    => 'required',
                'email'    => 'required',
                'gender' => 'required'
                );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $messages           = $validator->messages();
                $result['status']   = 0;
                $result['message']  = $messages;

                return response()->json($result);
            }

            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->gender = $request->gender;

            $res = $user->update();
            if($res){
                $result =  [
                    "status"=>1,
                    "Result"=>"Data has been updated",
                    "user"=>$user
                ];
            }else{
                $result =  [
                    "status"=>0,
                    "Result"=>"Data is not updated"
                ];
            }
        }
        catch (\Exception $e) {
            $result['status']  = 0;
            $result['message'] = 'Oops!! Unable to process your request. Please check the data and try again.';
            throw new HttpException(500, $e->getMessage());
        }
        return response()->json($result, 200);
    }
    public function create_uid(Request $request){
        try{
            $rules = array(
                'uid'    => 'required',
                'id'    => 'required'
                );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $messages           = $validator->messages();
                $result['status']   = 0;
                $result['message']  = $messages;

                return response()->json($result);
            }

            $user = User::find($request->id);
            $user->uid = $request->uid;
            $res = $user->update();
            if($res){
                $result = [
                    'status' => 1,
                    'message' => 'Data Updated successfully'
                ];
            }else{
                $result = [
                    'status' => 0,
                    'message' => 'Data not Updated'
                ];
            }

        }catch (\Exception $e) {
            $result['status']  = 0;
            $result['message'] = 'Oops!! Unable to process your request. Please check the data and try again.';
            //throw new HttpException(500, $e->getMessage());
        }
        return response()->json($result, 200);

    }

    function update_uid(Request $request, $id){

        try{
            $rules = array(
                'new_uid'    => 'required',
                'old_uid'    => 'required',
                );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $messages           = $validator->messages();
                $result['status']   = 0;
                $result['message']  = $messages;

                return response()->json($result);
            }

            $user = User::find($id);
            if($request->old_uid == $user->uid){
                $user->uid = $request->new_uid;
                $res = $user->update();
                if($res){

                    $result['status']  = 1;
                    $result['message'] = 'Data has been updated';

                }else{

                    $result['status']  = 0;
                    $result['message'] = 'Data not updated';

                }
            }else{

                $result['status']  = 0;
                $result['message'] = 'Old uid not correct';
            }
        }catch (\Exception $e) {
            $result['status']  = 0;
            $result['message'] = 'Oops!! Unable to process your request. Please check the data and try again.';
            //throw new HttpException(500, $e->getMessage());
        }
        return response()->json($result, 200);

    }
    function update_addr(Request $request, $id){

        try{
            $rules = array(
                'address'    => 'required'
                );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $messages           = $validator->messages();
                $result['status']   = 0;
                $result['message']  = $messages;

                return response()->json($result);
            }

            $user = User::find($id);

                $user->address = $request->address;
                $res = $user->update();
                if($res){

                    $result['status']  = 1;
                    $result['message'] = 'Address has been updated';

                }else{

                    $result['status']  = 0;
                    $result['message'] = 'Address not updated';

                }

        }catch (\Exception $e) {
            $result['status']  = 0;
            $result['message'] = 'Oops!! Unable to process your request. Please check the data and try again.';
            //throw new HttpException(500, $e->getMessage());
        }
        return response()->json($result, 200);

    }

        public function update_avatar(Request $request)
        {
            try{
                $rules = array(
                    'profile_img'    => 'required',
                    'id'    => 'required',
                    );

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    $messages           = $validator->messages();
                    $result['status']   = 0;
                    $result['message']  = $messages;

                    return response()->json($result);
                }
            //define('UPLOAD_DIR', 'images/profile/');

            $img = $request->profile_img;
            $id = $request->id;

            $destinationPath = 'images/profile/';
            $profileImage = date('YmdHis') . "." . $img->getClientOriginalExtension();
            $img->move($destinationPath, $profileImage);

            $user = User::find($request->id);
            $user->profile_img = $profileImage;
            $res = $user->update();
            if($res){
                $result['status']  = 1;
                $result['message'] = 'Profile Pic has been updated';
            }else{
                $result['status']  = 0;
                $result['message'] = 'Profile Pic not updated';
            }

            //print $success ? $file : 'Unable to save the file.';

        }catch (\Exception $e) {
            $result['status']  = 0;
            $result['message'] = 'Oops!! Unable to process your request. Please check the data and try again.';
            //throw new HttpException(500, $e->getMessage());
        }
            return response()->json($result);

        }

    function otp_check(Request $request){
        $otp_value = Session::get('session_otp');
        if($request->otp == $otp_value){
            return ["Result"=>"OTP Matched"];
        }else{
            return ["Result"=>"OTP Not Matched"];
        }

    }
    public function qrcode(Request $request)
    {
        $user = User::find($request->user_id);
        if(!empty($user))
        {
            $user_id = Crypt::encryptString($request->user_id);
            \QrCode::size(450)
        ->format('png')
        ->generate('http://kinneyinfo.com/?keyword='.$user_id, public_path('images/'.$user_id.'.png'));
        }

        $user->qrcode = $user_id;
        $user->save();

        return response()->json(['success'=>'QRCode created successfully.']);
    }

    function user_list(){
        return User::all();
    }
    /*
    function user_list($id=null){
        return $id?User::find($id):User::all();
    }
    https://spruko.com/demo/zanex/zanex/LTR/Verticalmenu-Icon-Light-Sidebar/index.html
    */
    function edit_user($id){
        try{
        $user = User::find($id);
        $trans = Wallet::where('trans_by_id', $user->id)
            ->orwhere('trans_to_id', $user->id)->first();
            $wallet = 'transaction empty';
            $service = Config::where('country_code', $user->country_code)->first();
            $serv = (object) array();
            if(!empty($service)){
                $serv = $service;
            }
            $avail_bank = DB::table('bank_accounts')->where('user_id', '=', $id)->count('id');
            $bank_avail = 0;
            if($avail_bank > 0){
                $bank_avail = 1;
            }
            if(!empty($trans)){
                $wallet = 'transaction available';
            }
            if($user){
                $result['status']  = 1;
                $result['user']  = $user;
                $result['wallet'] = $wallet;
                $result['processing_fee'] = $serv;
                $result['bank_acc'] = $bank_avail;
                $result['message'] = 'Success';
            }else{
                $result['status']  = 0;
                $result['message'] = 'Failed';
            }
        }
        catch (\Exception $e) {
            $result['status']  = 0;
            $result['message'] = 'Oops!! Unable to process your request. Please check the data and try again.';
            //throw new HttpException(500, $e->getMessage());
        }
        return response()->json($result, 200);
    }

    function add_user(Request $req){
        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->mobile = $req->mobile;
        $user->country_code = $req->country_code;
        $user->is_admin = $req->is_admin;
        //$user->password = Hash::make($req->password);
        $res = $user->save();
        if($res){
            return [
                "status"=>"success",
                "Result"=>"Data has been saved",
                "user" => $user
            ];
        }else{
            return [
                "status"=>"failed",
                "Result"=>"Data is not saved"

            ];
        }

    }

    function user_status($id, Request $req){
        $user = User::find($id);
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

    function delete_user($id){
        $user = User::find($id);
        $res = $user->delete();
        if($res){
            return [
                "status" => "success",
                "Result"=>"Data has been deleted"
            ];
            }
        else{
            return [
                "status"=>"failed",
                "Result"=>"Data is not deleted"
            ];
        }
    }

    function forget_uid($id, Request $req){
        try{
            $rules = array(
                'mobile'    => 'required',
                'country_code' => 'required'
                );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $messages           = $validator->messages();
                $result['status']   = 0;
                $result['message']  = $messages;

                return response()->json($result);
            }

            if(!empty($req->mobile)){
                $user_mob = User::find($id);
                if($user_mob->mobile == $req->mobile){

                    $receiverNumber = '+'.$request->country_code.''.$request->mobile;
                    $fourRandomDigit = rand(1000,9999);
                    $message = "Kinney Pay OTP to vaildate your mobile number is: $fourRandomDigit";

                    try {

                        /* $account_sid = getenv("TWILIO_SID");
                        $auth_token = getenv("TWILIO_TOKEN");
                        $twilio_number = getenv("TWILIO_FROM"); */

                        /* Mahesh account details
                        $account_sid = "AC6eff70616258f2cc34f871ded806479d";
                        $auth_token = "6cfa9fcb226bbf904708609c340ae8ab";
                        $twilio_number = "+18787897593";

                        Narayani account details
                        $account_sid = "ACa543faa1fdfaf5fac5fbb5f2b0360b73";
                        $auth_token = "a5dec2cda122479c3127d6c026a6f9b4";
                        $twilio_number = "+13192507024";

                        */

                    $account_sid = "ACb3fb8b517a0ff1380b7d8823ddf703aa";
                    $auth_token = "829779e1145399781d3a2f6fa743caaf";
                    $twilio_number = "+13185586277";

                        $client = new Client($account_sid, $auth_token);
                        $client->messages->create($receiverNumber, [
                            'from' => $twilio_number,
                            'body' => $message]);

                        //dd('SMS Sent Successfully.');
                        Session::forget('session_otp');
                        Session::put('session_otp', $fourRandomDigit);
                        return [
                            "status"=>"Success",
                            "OTP"=>$fourRandomDigit,
                        ];

                    } catch (Exception $e) {
                        //dd("Error: ". $e->getMessage());
                        return [
                            "status"=>"Failed",
                            "message"=>"The number  is unverified. Trial accounts cannot send messages to unverified numbers; verify  at twilio.com/user/account/phone-numbers/verified, or purchase a Twilio number to send messages to unverified numbers",
                        ];
                    }


                }else{
                    return [
                        "status"=>"Failed",
                        "message"=>"Mobile Number Not Found"
                    ];
                }

            }else{
                $otp_value = Session::get('session_otp');
                if($req->opt == $otp_value && $req->verify == 'verified'){
                    if(!empty($req->uid)){
                        $user = User::find($id);
                        $user->uid = $req->uid;
                        $res = $user->update();
                        if($res){
                        return [
                            "status"=>"Success",
                            "message"=>"User PIN Updated Successfully"
                        ];
                        }else{
                        return [
                            "status"=>"Failed",
                            "message"=>"User PIN Not Updated"
                        ];
                        }
                    }else{
                        return [
                            "status"=>"Failed",
                            "message"=>"Mobile Number or User Not Found"
                        ];
                    }
                }else{
                    return [
                        "status"=>"Failed",
                        "message"=>"OTP Not Match"
                    ];
                }
            }
         }catch (\Exception $e) {
                $result['status']  = 0;
                $result['message'] = 'Oops!! Unable to process your request. Please check the data and try again.';
                //throw new HttpException(500, $e->getMessage());
                return response()->json($result, 200);
            }


    }









}
