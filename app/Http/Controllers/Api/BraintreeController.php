<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BraintreeController extends Controller
{

    // public function generate(Request $request, Gateway $gateway){
    //     $token = $gateway->clientToken()->generate();

    //     $clientToken = $gateway->clientToken()->generate([
    //         "customerId" => $CustomerId
    //     ]);

    //     $data = [
    //         'success' => true,
    //         'token' => $token
    //     ];

    //     return response()->json($data, 200);
    // }

    // public function makePayment(OrderRequest $request, Gateway $gateway){

    //     $nonceFromTheClient = $_POST["payment_method_nonce"];
    //     $deviceDataFromTheClient = $_POST["payment_method_deviceData"];

    //     $result = $gateway->transaction()->sale([
    //         'amount' => '10.00',
    //         'paymentMethodNonce' => $nonceFromTheClient,
    //         'deviceData' => $deviceDataFromTheClient,
    //         'options' => [
    //         'submitForSettlement' => True
    //         ]
    //     ]);

    //     if($result->success){
    //         $data = [
    //             'success' => true,
    //             'message' => "Transazione eseguita con successo"
    //         ];
    //         return response()->json($data, 200);
    //     }else{

    //         $data = [
    //             'success' => false,
    //             'message' => "Transazione fallita"
    //         ];


    //         return response()->json($data, 401);

    //     }

    // }


}
