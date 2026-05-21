@extends('layouts.app')
@section('title', 'Edit Kategori')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Kategori</h1>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left mr-1"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('categories.update', $category) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group">
                <label>Nama Kategori <span class="text-danger">*</span></label>
                <input type="text" name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $category->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="description" rows="3"
                          class="form-control @error('description') is-invalid @enderror">{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <hr>
            <button type="submit" class="btn btn-warning">
                <i class="fas fa-save mr-1"></i> Update Kategori
            </button>
            <a href="{{ route('categories.index') }}" class="btn btn-light">Batal</a>
        </form>
    </div>
</div>
@endsection
