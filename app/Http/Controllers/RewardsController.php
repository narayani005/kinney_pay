<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Rewards;

class RewardsController extends Controller
{
    function my_rewards(){
        $id = auth()->user()->id;

        //$data = Rewards::all();
        $data = DB::table('rewards')
        ->where('trans_to', $id)->orwhere('trans_by', $id)->get();
        
        if(Auth()->user()->is_admin == 1){
            return view('admin.rewards', ['datas' => $data]);
        }else{
            return view('user.rewards', ['datas' => $data]);
        }
        
    }
}
