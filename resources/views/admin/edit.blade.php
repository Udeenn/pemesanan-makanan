@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Produk</h2>

        <form action="{{ route('admin.update', $products->id_product) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="product_name">Nama Produk</label>
                <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $products->product_name }}" required>
            </div>
            <div class="form-group">
                <label for="product_description">Deskripsi Produk</label>
                <textarea class="form-control" id="product_description" name="product_description">{{$products->product_description}}</textarea>
            </div>
            <div class="form-group">
                <label for="product_price">Harga Produk</label>
                <input type="number" class="form-control" id="product_price" name="product_price" value="{{$products->product_price}}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Produk</button>
        </form>
    </div>
@endsection

