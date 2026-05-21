@extends('layouts.app')
@section('title', 'Produk')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Daftar Produk</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm shadow-sm">
        <i class="fas fa-plus fa-sm mr-1"></i> Tambah Produk
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td>{{ $products->firstItem() + $loop->index }}</td>
                        <td class="text-center">
                            @if($product->image)
                                <img src="{{ asset('storage/'.$product->image) }}"
                                     width="50" height="50"
                                     style="object-fit:cover;border-radius:6px">
                            @else
                                <span class="text-muted"><i class="fas fa-image"></i></span>
                            @endif
                        </td>
                        <td><strong>{{ $product->name }}</strong></td>
                        <td>
                            <span class="badge badge-info">
                                {{ $product->category->name ?? '-' }}
                            </span>
                        </td>
                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>
                            @if($product->stock <= 5)
                                <span class="badge badge-danger">{{ $product->stock }}</span>
                            @else
                                <span class="badge badge-success">{{ $product->stock }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('products.edit', $product) }}"
                               class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('products.destroy', $product) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin hapus produk ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Belum ada produk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $products->links() }}
    </div>
</div>
@endsection
