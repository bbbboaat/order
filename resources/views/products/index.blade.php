@extends('layouts.app')
<!-- use layouts ap
p.blade.php -->

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <a class = "mb-3 btn btn-primary"href="{{ route ('products.create')}}">Create Product</a>
                <div class="row">
                    <div class="col-4">
                        Product1
                    </div>
                    <div class="col-4">
                        {{$productsView}}
                    </div>
                    <div class="col-4">
                        Product3
                    </div>


                </div>

            </div>
        </div>
    </div>
@endsection
