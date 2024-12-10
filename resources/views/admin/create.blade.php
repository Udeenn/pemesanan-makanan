@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Produk Baru</h2>

        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="product_name">Nama Produk</label>
                <input type="text" class="form-control" id="product_name" name="product_name" value="{{ old('product_name') }}" required>
            </div>
            <div class="form-group">
                <label for="product_description">Deskripsi Produk</label>
                <textarea class="form-control" id="product_description" name="product_description" rows="4" required>{{ old('product_description') }}</textarea>
            </div>
            <div class="form-group">
                <label for="product_price">Harga Produk</label>
                <input type="number" class="form-control" id="product_price" name="product_price" value="{{ old('product_price') }}" required>
            </div>
            <div class="form-group">
                <label for="image">Gambar Produk</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Produk</button>
        </form>
    </div>
@endsection
