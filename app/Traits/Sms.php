<?php
namespace App\Traits;


use App\Models\SiteSetting;
use Illuminate\Support\Facades\Auth;

trait Sms
{
    function sendSms($contact,$msg) {
     $url = "https://sms.solutionsclan.com/api/sms/send";
$data = [
"apiKey"=> "A0003234f11896d-e64a-442c-bf6b-9c3090ff9c99",
"contactNumbers"=> $contact,
"senderId"=> "8809612440709",
"textBody"=> $msg
];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
$response = curl_exec($ch);

curl_close($ch);
    }
}




