<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Exception;

class NexmoSMSController extends Controller
{
    public function index()
    {
        try {
            //echo getenv("NEXMO_KEY");die();
            $basic  = new \Nexmo\Client\Credentials\Basic(env("NEXMO_KEY"), env("NEXMO_SECRET"));
            $client = new \Nexmo\Client($basic);
            print_r($client);die();
            $receiverNumber = "XXXXXXXXXX";
            $fourRandomDigit = rand(1000,9999);
            $message = "Kinney Pay OTP is $fourRandomDigit";
  
            $message = $client->message()->send([
                'to' => $receiverNumber,
                'from' => 'Kinney Pay',
                'text' => $message
            ]);
  
            dd('SMS Sent Successfully.');
              
        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }
    }
}
