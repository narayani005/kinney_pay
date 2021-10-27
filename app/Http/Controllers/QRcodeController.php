<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Response;

class QRcodeController extends Controller
{
    public function qrCodeCreate(Request $request)
    {
        $user = User::find($request->user_id);
        if(!empty($user))
        {
            $user_id = Crypt::encryptString($request->user_id);
            \QrCode::size(450)
        ->format('png')
        ->generate('https://kinneyinfo.com/?keyword='.$user_id, public_path('images/'.$user_id.'.png')); 
        }

        $user->qrcode = $user_id;
        $user->save();
  
        return response()->json(['success'=>'QRCode created successfully.']);
    }

    public function qrDownload(Request $request)
    {
        $filepath = public_path('images/').$request->qrcode.'.png';
        return Response::download($filepath);
    }

    public function qrcode(Request $request){
        $id = auth()->user()->id;
        $data = User::find($id);
        return $data;
    }
}
