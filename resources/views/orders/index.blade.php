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
                            <th>Price</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $item)
                        <td>{{ $item->name}}</td>
                            <td>{{ $item->price}}</td>
                            <td>{{ $item->amount}}</td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
