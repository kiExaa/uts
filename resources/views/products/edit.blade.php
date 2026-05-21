@extends('layouts.app')
@section('title', 'Edit Produk')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Produk</h1>
    <a href="{{ route('products.index') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left mr-1"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Nama Produk <span class="text-danger">*</span></label>
                        <input type="text" name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $product->name) }}">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label>Kategori <span class="text-danger">*</span></label>
                        <select name="category_id"
                                class="form-control @error('category_id') is-invalid @enderror">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Harga (Rp) <span class="text-danger">*</span></label>
                                <input type="number" name="price"
                                       class="form-control @error('price') is-invalid @enderror"
                                       value="{{ old('price', $product->price) }}" min="0">
                                @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Stok <span class="text-danger">*</span></label>
                                <input type="number" name="stock"
                                       class="form-control @error('stock') is-invalid @enderror"
                                       value="{{ old('stock', $product->stock) }}" min="0">
                                @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="description" rows="4"
                                  class="form-control">{{ old('description', $product->description) }}</textarea>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Gambar Produk</label>
                        @if($product->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/'.$product->image) }}"
                                     style="width:100%;border-radius:8px;max-height:180px;object-fit:cover">
                                <small class="text-muted">Gambar saat ini</small>
                            </div>
                        @endif
                        <input type="file" name="image" id="imageInput"
                               class="form-control-file @error('image') is-invalid @enderror"
                               accept="image/*" onchange="previewImage(this)">
                        @error('image') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        <div class="mt-2">
                            <img id="imagePreview" src="#" alt="Preview"
                                 style="display:none;width:100%;border-radius:8px;max-height:180px;object-fit:cover">
                        </div>
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                    </div>
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-warning">
                <i class="fas fa-save mr-1"></i> Update Produk
            </button>
            <a href="{{ route('products.index') }}" class="btn btn-light">Batal</a>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
