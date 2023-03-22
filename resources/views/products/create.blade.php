@extends('layouts.app')
<!-- use layouts ap
p.blade.php -->

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">

                <form action="{{ route ('products.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="">name</label>
                    <input class="form-control" tpye="type" name="name">
                    <label for="">price</label>
                    <input class="form-control" tpye="number" name="price">
                    <label for="">Image</label>
                    <input type="file" class="form-control" name="image">
                    <button type="submit" class = "mt-3 btn btn-success" >create product</button>
                </form>

            </div>
        </div>
    </div>
@endsection
