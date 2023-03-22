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
        $order = Order::where('user_id', Auth::id())->where('status', 0)->first();
        if ($order == NULL) {
            return view('orders.empty');
        } else {


            // dd($order);
            return view('orders.index')->with('order', $order);
        }
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

        $product = Product::find($request->product_id);
        $order = Order::where('user_id', Auth::id())->where('status', 0)->first();
        if ($order) {
            $cartDetail = $order->order_details()->where('product_id', $product->id)->first();

            if ($cartDetail) {
                $amountNew = $cartDetail->amount + 1;
                $cartDetail->update([
                    'amount' => $amountNew
                ]);
            } else {
                $prepareOrderDetail = [
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'amount' => 1,
                    'price' => $product->price,

                ];


                $orderDetail = OrderDetail::create($prepareOrderDetail);

            }
        } else {

            $prepareOrder = [
                'status' => 0,
                'user_id' => Auth::id()
            ];


            $order = Order::create($prepareOrder);




            $prepareOrderDetail = [
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'amount' => 1,
                'price' => $product->price,

            ];


            $orderDetail = OrderDetail::create($prepareOrderDetail);
        }


        $subTotal = 0;
        $total = $order->order_details->map(function ($orderDetail) use ($subTotal) {
            $subTotal += $orderDetail->amount * $orderDetail->price;
            return $subTotal;
        })->toarray();

        // dd(array_sum($subTotal));
        $order->update([
            'total' => array_sum($total)
        ]);

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
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
