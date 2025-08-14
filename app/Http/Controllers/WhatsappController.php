<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Exception;
use Twilio\Rest\Client;
 
class WhatsappController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
         
    }
 
    
    public function index()
    {
        return view('whatsapp_message');
    }
     
      public function sendWhatsappMessage(Request $request)
    {
        
        $request->validate([
            'phone' => 'required ',
            'message' => 'required | max:255',
        ]);
 
        $receiverNumber = "whatsapp:+".$request->phone;
        $message = $request->message;
        try {
   
            $account_sid = getenv ("TWILIO_SID");
            $auth_token = getenv("TWILIO_AUTH_TOKEN");
            $twilio_number = getenv("TWILIO_WHATSAPP_NUMBER");
   
            $client = new Client($account_sid, $auth_token);
            $client->messages->create(  $receiverNumber, // To,
             [
                'from' => "whatsapp:". $twilio_number, 
                'body' => $message]);
             return back()->withSuccess('Whatsapp Message Sent Successfully!');
        } 
        catch (Exception $e) {
            return back()->with(['error' => $e->getMessage()]);
        }
    }
}