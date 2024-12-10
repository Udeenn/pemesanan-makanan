@extends('layouts.app')

@section('content')
    <div class="container mx-4">
        <h2>Daftar Produk</h2>
        <ul>
            <a class="btn btn-success" href="{{ route('admin.create') }}">Tambah Produk</a>
        </ul>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Produk</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->product_description }}</td>
                        <td>Rp {{ number_format($product->product_price, 0, ',', '.') }}</td>
                        <td><img src="{{ asset('images/' . $product->image) }}" alt="Product Image" width="50"></td>
                        <td>
                            <a href="{{ route('admin.edit', $product->id_product) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.destroy', $product->id_product) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
