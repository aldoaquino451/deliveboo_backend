<?php

namespace App\Http\Controllers\Api\Orders;

use App\Models\Order;
use Braintree\Gateway;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\OrderRequest;

class OrderController extends Controller
{
    public function generate(Request $request, Gateway $gateway){
        $token = $gateway->clientToken()->generate();

        $clientToken = $gateway->clientToken()->generate([
            "customerId" => $CustomerId
        ]);

        $data = [
            'success' => true,
            'token' => $token
        ];

        return response()->json($data, 200);
    }

    public function makePayment(OrderRequest $request, Gateway $gateway){

        $nonceFromTheClient = $_POST["payment_method_nonce"];
        $deviceDataFromTheClient = $_POST["payment_method_deviceData"];

        $result = $gateway->transaction()->sale([
            'amount' => '10.00',
            'paymentMethodNonce' => $nonceFromTheClient,
            'deviceData' => $deviceDataFromTheClient,
            'options' => [
            'submitForSettlement' => True
            ]
        ]);

        if($result->success){
            $data = [
                'success' => true,
                'message' => "Transazione eseguita con successo"
            ];
            return response()->json($data, 200);
        }else{

            $data = [
                'success' => false,
                'message' => "Transazione fallita"
            ];


            return response()->json($data, 401);

        }

    }

    public function getDataChart(){
        $orders = Order::
        select([
            // 'created_at',
            DB::raw('MONTHNAME(`created_at`) as x'),
            // DB::raw('DATE_FORMAT("created_at", "%m") as x'),
            DB::raw('COUNT(0) as orders')])
        // ->groupBy(DB::raw('created_at'))
        ->groupBy(DB::raw('MONTHNAME(`created_at`)'))
        // ->groupBy(DB::raw('DATE_FORMAT("created_at", "%m")'))
        ->get();

        return response()->json($orders->toArray());

        // ORDINI CI SONO ? 2 in un ristorante solo,

    }
}
