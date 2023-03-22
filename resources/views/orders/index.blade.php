@extends('layouts.app')
<!-- use layouts ap
p.blade.php -->

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Amount</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->order_details as $item)
                            <tr>
                                <td>{{ $item->product_name}}</td>
                                <td>{{ $item->amount}}</td>
                                <td>{{ $item->price}}</td>
                                <td>

                                <div class="row text-center">
                                    <div class="col-6">
                                        <form action="{{route('orders.update' , $order->id)}}" method="post">
                                            @csrf
                                            @method('put')
                                            <input type="hidden" value="increase" name="value">
                                            <input type="hidden" name="product_id" value="{{$item->product_id}}">
                                            <button class="btn btn-outline-success" type = "submit">+</button>

                                        </form>
                                    </div>
                                    <div class="col-6">
                                        <form action="{{route('orders.update' , $order->id)}}" method="post">
                                            @csrf
                                            @method('put')
                                            <input type="hidden" value="decrease" name="value">
                                            <input type="hidden" name="product_id" value="{{$item->product_id}}">
                                            <button class="btn btn-outline-danger" type = "submit">-</button>
                                        </form>

                                    </div>
                                </div>
                                </td>
                            </tr>
                        @endforeach
                        <td>-</td>
                        <td>-</td>
                        <td>{{ $order->total}}</td>
                        <td class="text-center">
                            <form action="">
                                @csrf
                                @method('put')
                                <input type="hidden" name="value" value=""checkout>
                                <button class="btn btn-outline-primary" type="submit">Checkout</button>
                            </form>
                        </td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
