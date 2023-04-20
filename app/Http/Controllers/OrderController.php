<?php

namespace App\Http\Controllers;

use App\Models\Production;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = array();
        $rows = Order::query()->select('items')->where('user_id', auth()->user()->id)->get();

        foreach ($rows as $row) {
            array_push($orders, json_decode($row->items));
        }

        return Inertia::render('Dashboard/Order/Index', [
            'orders' => $orders
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $res = Order::where('user_id', '=', auth()->user()->id)
            ->first();

        if (!is_null($res)) {
            $res->total = $request->total;
            $res->total_decimal = $request->total_decimal;
            $res->items = json_encode($request->items);
            $res->save();
        } else {
            $order = new Order();
            $order->user_id = auth()->user()->id;
            $order->total = $request->total;
            $order->total_decimal = $request->total_decimal;
            $order->items = json_encode($request->items);
            $order->save();
        }

        return to_route('cart.index')->with('cart', 'Production stocked successfully.');
    }
}
