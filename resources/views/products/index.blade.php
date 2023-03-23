@extends('layouts.app')
<!-- use layouts ap
p.blade.php -->

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">

                @if(Auth::user()->type ==1)
                    <a class = "mb-3 btn btn-primary"href="{{ route ('products.create')}}">Create Product</a>
                @endif


                <form action="{{route ('products.index')}}" method="get">
                    <div class="d-flex justify-content my-2">
                        <input class="form-control" type="text" name="search" placeholder="search">
                        <button type="submit" class="btn btn-info col-3">Search</button>
                    </div>
                </form>


                <div class="row">
                    @foreach ($productsView as $item)
                    <div class="col-4">

                        <form action="{{route('orders.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$item->id}}">
                            <div class="card p-3 mt-5 ">
                                <img class="rounded-3" src="{{asset('storage/' . $item->image)}}" alt="">
                                <h4 class="mt-3">Product Name : {{$item -> name}}</h4>
                                <p>Price : {{$item -> price}}</p>

                            <button class="btn btn-secondary" type="submit">Order</button>
                            </div>

                        </form>

                        @if(Auth::user()->type ==1)
                        <div class="d-flex justify-content-around" >
                            <a href="{{route('products.edit',$item->id)}}" class="btn btn-warning mt-2 ">edit</a>
                            <form action="{{route('products.destroy' , $item->id)}}" method = "post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger mt-2 ">Delete Product</button>
                            </form>
                        </div>

                        @endif

                    </div>

                    @endforeach
                    <div class="mt-5">

                        {{ $productsView->links('pagination::bootstrap-4')}}
                    </div>


                </div>

            </div>
        </div>
    </div>
@endsection
