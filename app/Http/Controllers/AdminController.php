<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Config;
use App\Models\User;

class AdminController extends Controller
{
   function configuration()
   {
        $data = Config::all();

        return view('admin.config.setup', ['data' => $data]);
   }

   function storeConfig(Request $request)
   {
        $configinfo = Config::where('currency_type', $request->currency_type)->first();

       if(!empty($configinfo)) {

        return redirect('/admin/config')->with('message', 'Configuration Already Exist');

       }else {
            $config = new Config();
            $config->country_code = $request->country_code; 
            $config->currency_type = $request->currency_type; 
            $config->service_charges = $request->service_charges; 
            $config->save();
        
            $data = Config::all();

            return view('admin.config.setup', ['data' => $data]);
       }

   }

   function destoryConfig($id){

          $account = Config::find($id);
          $res = $account->delete();
          if($res){
          return redirect('/admin/config')->with('message', 'Configuration Deleted Successfully');
          
          }else{
          return redirect('/admin/config')->with('message', 'Configuration Not Deleted');

          }
     }

     function user_status($status, $id){
     $user = User::find($id);
     $user->status = $status;
     $res = $user->update();
     if($res){
          return redirect('/admin/users')->with('message', 'Status Changed Successfully');
          
          }else{

          return redirect('/admin/users')->with('message', 'Status Not Changed');

          }
     }

     function user_sub_plans()
     {
          return view('admin.subscribe_plans');
     }
}
