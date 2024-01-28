<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Mail\NewOrderClient;
use App\Mail\NewOrderRestaurant;

class LeadController extends Controller
{
    public function send($order_id){
        
        $order = Order::with('products')->where('id', $order_id)->first();
       
        
        // $data = $order->all();

        // $email_user = $order->email;
        // $email_restaurant = $order->restaurant->user->email;

        // invio l'email
        Mail::to($order->email)->send(new NewOrderClient($order));
        Mail::to($order->restaurant->user->email)->send(new NewOrderRestaurant($order));


        // restituisco success = true
        $success = true;
        return response()->json(compact('success'));
    }

}
