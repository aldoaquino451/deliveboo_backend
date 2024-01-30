<?php

namespace App\Http\Controllers\Api\Orders;

use Carbon\Carbon;
use App\Models\Order;
use Braintree\Gateway;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Orders\OrderRequest;

class OrderController extends Controller
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

    public function getDataChart(){
        $anno_corrente = Carbon::now()->year;

        $orders_month = Order::
        select([
            // DB::raw('MONTHNAME(`created_at`) as x'),
            DB::raw('MONTH(`created_at`) as x'),
            DB::raw('COUNT(0) as orders')])
            ->where('restaurant_id', Auth::id())
            ->whereYear('created_at', $anno_corrente)
            ->groupBy(DB::raw('MONTH(`created_at`)'))
            ->orderBy(DB::raw('MONTH(`created_at`)'))
            ->get();

        return response()->json($orders_month->toArray());
    }
    public function getDataChartYear(){

        // Esegue la query per ottenere i dati degli ordini per anno
        $orders_year = Order::
            select([
                DB::raw('YEAR(`created_at`) as year'),
                DB::raw('COUNT(0) as orders')
            ])
            ->where('restaurant_id', Auth::id())
            ->groupBy(DB::raw('YEAR(`created_at`)'))
            ->orderBy(DB::raw('YEAR(`created_at`)'))
            ->get();

        // Estrae gli anni dalla collezione di risultati
        $years = $orders_year->pluck('year')->toArray();

        // Costruisce un array contenente sia i dati degli ordini che gli anni
        $data = [
            'orders' => $orders_year->toArray(),
            'years' => $years
        ];

        // Restituisce la risposta JSON
        return response()->json($data);
    }

    public function getAmountChartMonth(){
        $anno_corrente = Carbon::now()->year;

        $amount_month = Order::
        select([
            // DB::raw('MONTHNAME(`created_at`) as x'),
            DB::raw('MONTH(`created_at`) as x'),
            DB::raw('SUM(total_price) as total')])
            ->where('restaurant_id', Auth::id())
            ->whereYear('created_at', $anno_corrente)
            ->groupBy(DB::raw('MONTH(`created_at`)'))
            ->orderBy(DB::raw('MONTH(`created_at`)'))
            ->get();

        return response()->json($amount_month->toArray());
    }

    public function getAmountChartYear(){

        // Esegue la query per ottenere i dati degli ordini per anno
        $orders_year = Order::
            select([
                DB::raw('YEAR(`created_at`) as year'),
                DB::raw('SUM(total_price) as amount')
            ])
            ->where('restaurant_id', Auth::id())
            ->groupBy(DB::raw('YEAR(`created_at`)'))
            ->orderBy(DB::raw('YEAR(`created_at`)'))
            ->get();

        // Estrae gli anni dalla collezione di risultati
        $years = $orders_year->pluck('year')->toArray();

        // Costruisce un array contenente sia i dati degli ordini che gli anni
        $data = [
            'amount' => $orders_year->toArray(),
            'years' => $years
        ];

        // Restituisce la risposta JSON
        return response()->json($data);
    }


    };
