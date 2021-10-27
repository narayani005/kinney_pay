<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beneficiar;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Validator;

class BeneficiarController extends Controller
{
    function index(){

        $id = Auth()->user()->id;
        $benefi = DB::table('beneficiars')
                ->join('users', 'users.id' , "=", 'beneficiars.benefi_id')
                ->select('beneficiars.id as pid','beneficiars.benefi_name' , 'users.*')
                ->where('beneficiars.user_id' , $id)
                ->get();

        return view('user.beneficiary.index', ['datas' => $benefi]);
    }

    function createBeneficiary(){

        return view('user.beneficiary.create');
    }

    function deleteBeneficiary($id){
        $benefi = Beneficiar::find($id);
        $res = $benefi->delete();
        if($res){
            return redirect('/beneficiary-index')->with('message', 'Beneficiary Deleted Successfully');
            
        }else{
            return redirect('/beneficiary-index')->with('message', 'Beneficiary Not Deleted');

        }
    }

    function editBeneficiary($id){

        $benefi = Beneficiar::find($id);
        $user = User::where('id', $benefi->benefi_id)->first();
        return view('user.beneficiary.edit', ['data' => $benefi, 'user' => $user]);

    }

    function updateBeneficiary(Request $res){

        $benefi = Beneficiar::find($res->pkey);
        $benefi->benefi_name = $res->benefi_name;
        $res = $benefi->update();
        return redirect('/beneficiary-index')->with('message', 'Beneficiary Data Updated Successfully');

    }


    function checkBeneficiary(Request $res){

        $id = $res->user_id;
        $user = User::where('mobile', $res->benefi_mobile)->first();

        if($user){

            $check = DB::table('beneficiars')
                        ->where('benefi_id', $user->id)
                        ->where('user_id', $id)
                        ->first();

                        if(empty($check)){

                            $benefi = new Beneficiar();
                            $benefi->benefi_name = $res->benefi_name; 
                            $benefi->user_id = $id; 
                            $benefi->benefi_id = $user->id; 
                            $result = $benefi->save();
                            if($result){
                                return redirect('/beneficiary-index')->with('message', 'Beneficiary Added Successfully');
                                
                            }else{
                                return redirect('/beneficiary-index')->with('message', 'Beneficiary Not Added');

                            }
                        
                        }else{
                            return redirect('/beneficiary-index')->with('message', 'Beneficiary Already Exist');
                        }
            }else{
                return redirect('/create-beneficiary')->with('message', 'Mobile Number Not Exist');
            }

        
    }

}
