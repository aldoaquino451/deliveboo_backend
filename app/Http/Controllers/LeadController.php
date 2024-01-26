<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Order;
use App\Mail\NewOrderClient;
use App\Mail\NewOrderRestaurant;

class LeadController extends Controller
{

    public function store(Order $order){

        $data = $order->all();

        $email_user = $data->email;
        $email_restaurant = $data->restaurant->user->email;

        // invio l'email
        Mail::to('info@deliveboo.com')->send(new NewOrderClient($email_user));
        Mail::to('info@deliveboo.com')->send(new NewOrderRestaurant($email_restaurant));


        // restituisco success = true
        // $success = true;
        // return response()->json(compact('success'));
    }



}
