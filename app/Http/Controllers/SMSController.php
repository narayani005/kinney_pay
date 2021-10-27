<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Twilio\Rest\Client;

class SMSController extends Controller
{
    public function index()
    {

        $receiverNumber = "+916381605508";
        $message = "OTP to vaildate your mobile phone number is:";
  
        try {
  
            /* $account_sid = getenv("TWILIO_SID"); 
            $auth_token = getenv("TWILIO_TOKEN"); 
            $twilio_number = getenv("TWILIO_FROM"); */

            $account_sid = "AC6eff70616258f2cc34f871ded806479d"; 
            $auth_token = "6cfa9fcb226bbf904708609c340ae8ab"; 
            $twilio_number = "+18787897593"; 
      
  
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number, 
                'body' => $message]);
  
            dd('SMS Sent Successfully.');
  
        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }
    }
}
