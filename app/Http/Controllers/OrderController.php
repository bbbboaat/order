<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = Order::all();
        return view('orders.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $prepareOrder = [
            'status' => 0,
            'user_id' => Auth::id()
        ];



        $order = Order::create($prepareOrder);

        $product = Product::find($request->product_id);

        $prepareOrderDetail = [
            'order_id' => $order->id,
            'product_id' => $product->id,
            'product_name' => $product->name,
            'amount' => 1,
            'price' => $product->id,

        ];


        $orderDetail = OrderDetail::create($prepareOrderDetail);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
