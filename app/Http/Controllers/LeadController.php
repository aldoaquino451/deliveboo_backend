<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Order;
use App\Mail\NewOrderClient;
use App\Mail\NewOrderRestaurant;

class LeadController extends Controller
{

    public function send($order){

        // $data = $order->all();

        // $email_user = $order->email;
        // $email_restaurant = $order->restaurant->user->email;

        // invio l'email
        Mail::to('info@deliveboo.com')->send(new NewOrderClient($order));
        Mail::to('info@deliveboo.com')->send(new NewOrderRestaurant($order));


        // restituisco success = true
        $success = true;
        return response()->json(compact('success'));
    }



}
