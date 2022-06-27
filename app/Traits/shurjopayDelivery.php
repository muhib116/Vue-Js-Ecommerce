<?php
namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait shurjopayDelivery
{
    function shurjopayNotify($txID) 
    {
        $url = 'https://portal.shurjopay.com/Verifydelivery/Confirm/'.$txID;
        $post_data=array(
        'order_id'=>$txID
        );
        $post_data=json_encode($post_data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1); //0 for a get request
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
    }
}