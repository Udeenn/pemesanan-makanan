@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Buat Transaksi Baru</h2>

    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf

        <!-- Buyer Name -->
        <div class="mb-3">
            <label for="buyer_name" class="form-label">Nama Pembeli</label>
            <input type="text" class="form-control @error('buyer_name') is-invalid @enderror" id="buyer_name" name="buyer_name" value="{{ old('buyer_name') }}" required>
            @error('buyer_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Products -->
        <div class="mb-3">
            <label for="product_id" class="form-label">Pilih Produk</label>
            <select class="form-select @error('product_id') is-invalid @enderror" id="product_id" name="product_id[]" multiple required>
                @foreach($products as $product)
                    <option value="{{ $product->id_product }}">{{ $product->product_name }} - Rp{{ number_format($product->product_price, 0, ',', '.') }}</option>
                @endforeach
            </select>
            <small class="text-muted">Gunakan Ctrl (Windows) atau Command (Mac) untuk memilih beberapa produk.</small>
            @error('product_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Total -->
        <div class="mb-3">
            <label for="total" class="form-label">Jumlah Produk</label>
            <input type="number" class="form-control @error('total') is-invalid @enderror" id="total" name="total" value="{{ old('total') }}" min="1" required>
            @error('total')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
    </form>
</div>
@endsection
