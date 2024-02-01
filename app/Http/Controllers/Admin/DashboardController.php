<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
  public function index()
  {

    return view('admin.dashboard.index');
  }


  public function getDataChart()
  {
    $anno_corrente = Carbon::now()->year;

    // Creare un array con tutti i mesi dell'anno corrente
    $mesi_anno_corrente = range(1, 12);

    // Eseguire la query per ottenere i dati degli ordini per ogni mese
    $orders_worked_months = Order::select([
        DB::raw('MONTH(`created_at`) as x'),
        DB::raw('COUNT(0) as orders')
      ])
      ->where('restaurant_id', Auth::id())
      ->whereYear('created_at', $anno_corrente)
      ->groupBy(DB::raw('MONTH(`created_at`)'))
      ->orderBy(DB::raw('MONTH(`created_at`)'))
      ->get();

    // Estrai i dati dalla query
    $orders_data = $orders_worked_months->pluck('orders', 'x')->toArray();

    // Unisci i dati effettivi con tutti i mesi dell'anno corrente
    $orders_month = array_map(function ($mese) use ($orders_data) {
      return [
        'x' => $mese,
        'orders' => $orders_data[$mese] ?? 0,
      ];
    }, $mesi_anno_corrente);

    return response()->json($orders_month);
  }


  public function getDataChartYear()
  {

    // Esegue la query per ottenere i dati degli ordini per anno
    $orders_year = Order::select([
        DB::raw('YEAR(`created_at`) as year'),
        DB::raw('COUNT(0) as orders')
      ])
      ->where('restaurant_id', Auth::id())
      ->groupBy(DB::raw('YEAR(`created_at`)'))
      ->orderBy(DB::raw('YEAR(`created_at`)'))
      ->get();


    // Estrae gli anni dalla collezione di risultati
    $years = $orders_year->pluck('year')->toArray();

    // Creare un array con tutti gli anni considerati
    $anni_da_considerare = range(min($years), max($years));

    // Estrai i dati dalla query
    $orders_data = $orders_year->pluck('orders', 'year')->toArray();

    // Unisci i dati effettivi con tutti gli anni considerati
    $merged_data = array_map(function ($anno) use ($orders_data) {
      return [
        'year' => $anno,
        'orders' => $orders_data[$anno] ?? 0,
      ];
    }, $anni_da_considerare);

    // Costruisce un array contenente sia i dati degli ordini che gli anni
    $data = [
      'orders' => $merged_data,
      'years' => $anni_da_considerare
    ];

    // Restituisce la risposta JSON
    return response()->json($data);
  }

  public function getAmountChartMonth()
  {
    $anno_corrente = Carbon::now()->year;

    $mesi_anno_corrente = range(1, 12);

    $amount_worked_wonths = Order::select([
        // DB::raw('MONTHNAME(`created_at`) as x'),
        DB::raw('MONTH(`created_at`) as x'),
        DB::raw('SUM(total_price) as total')
      ])
      ->where('restaurant_id', Auth::id())
      ->whereYear('created_at', $anno_corrente)
      ->groupBy(DB::raw('MONTH(`created_at`)'))
      ->orderBy(DB::raw('MONTH(`created_at`)'))
      ->get();

    // Estrai i dati dalla query
    $amount_data = $amount_worked_wonths->pluck('total', 'x')->toArray();

    // Unisci i dati effettivi con tutti i mesi dell'anno corrente
    $amount_month = array_map(function ($mese) use ($amount_data) {
      return [
        'x' => $mese,
        'total' => $amount_data[$mese] ?? 0,
      ];
    }, $mesi_anno_corrente);


    return response()->json($amount_month);
  }

  public function getAmountChartYear()
  {

    // Esegue la query per ottenere i dati degli ordini per anno
    $orders_year = Order::select([
        DB::raw('YEAR(`created_at`) as year'),
        DB::raw('SUM(total_price) as amount')
      ])
      ->where('restaurant_id', Auth::id())
      ->groupBy(DB::raw('YEAR(`created_at`)'))
      ->orderBy(DB::raw('YEAR(`created_at`)'))
      ->get();


    // Estrae gli anni dalla collezione di risultati
    $years = $orders_year->pluck('year')->toArray();

    // Creare un array con tutti gli anni considerati
    $anni_da_considerare = range(min($years), max($years));

    // Estrai i dati dalla query
    $amount_data = $orders_year->pluck('amount', 'year')->toArray();

    // Unisci i dati effettivi con tutti gli anni considerati
    $merged_data = array_map(function ($anno) use ($amount_data) {
      return [
        'year' => $anno,
        'amount' => $amount_data[$anno] ?? 0,
      ];
    }, $anni_da_considerare);

    // Costruisce un array contenente sia i dati degli ordini che gli anni
    $data = [
      'amount' => $merged_data,
      'years' => $anni_da_considerare
    ];

    // Restituisce la risposta JSON
    return response()->json($data);
  }
}
