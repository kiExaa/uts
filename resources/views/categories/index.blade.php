@extends('layouts.app')
@section('title', 'Kategori')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Daftar Kategori</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm shadow-sm">
        <i class="fas fa-plus fa-sm mr-1"></i> Tambah Kategori
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th width="50">#</th>
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th width="80">Produk</th>
                        <th width="140">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td>{{ $categories->firstItem() + $loop->index }}</td>
                        <td><strong>{{ $category->name }}</strong></td>
                        <td>{{ Str::limit($category->description, 60, '...') ?? '-' }}</td>
                        <td class="text-center">
                            <span class="badge badge-primary">{{ $category->products_count }}</span>
                        </td>
                        <td>
                            <a href="{{ route('categories.edit', $category) }}"
                               class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('categories.destroy', $category) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin hapus kategori ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada kategori.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $categories->links() }}
    </div>
</div>
@endsection
