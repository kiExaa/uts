@extends('layouts.app')
@section('title', 'Catat Transaksi')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Catat Transaksi Baru</h1>
    <a href="{{ route('transactions.index') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left mr-1"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Pelanggan <span class="text-danger">*</span></label>
                        <input type="text" name="customer_name"
                               class="form-control @error('customer_name') is-invalid @enderror"
                               value="{{ old('customer_name') }}"
                               placeholder="Nama pelanggan">
                        @error('customer_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tanggal Transaksi <span class="text-danger">*</span></label>
                        <input type="date" name="transaction_date"
                               class="form-control @error('transaction_date') is-invalid @enderror"
                               value="{{ old('transaction_date', date('Y-m-d')) }}">
                        @error('transaction_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Produk <span class="text-danger">*</span></label>
                        <select name="product_id" id="productSelect"
                                class="form-control @error('product_id') is-invalid @enderror"
                                onchange="updatePrice(this)">
                            <option value="">-- Pilih Produk --</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}"
                                        data-price="{{ $product->price }}"
                                        {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }} (Rp {{ number_format($product->price, 0, ',', '.') }}) — Stok: {{ $product->stock }}
                                </option>
                            @endforeach
                        </select>
                        @error('product_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Jumlah <span class="text-danger">*</span></label>
                        <input type="number" name="quantity" id="qtyInput"
                               class="form-control @error('quantity') is-invalid @enderror"
                               value="{{ old('quantity', 1) }}" min="1"
                               onchange="calcTotal()">
                        @error('quantity') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Status <span class="text-danger">*</span></label>
                        <select name="status"
                                class="form-control @error('status') is-invalid @enderror">
                            <option value="pending" {{ old('status')=='pending' ? 'selected' : '' }}>Pending</option>
                            <option value="success" {{ old('status')=='success' ? 'selected' : '' }}>Sukses</option>
                            <option value="cancelled" {{ old('status')=='cancelled' ? 'selected' : '' }}>Batal</option>
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="alert alert-info">
                <strong>Total Harga: </strong>
                <span id="totalDisplay">Rp 0</span>
                <small class="text-muted ml-2">(dihitung otomatis)</small>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-1"></i> Simpan Transaksi
            </button>
            <a href="{{ route('transactions.index') }}" class="btn btn-light">Batal</a>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
let currentPrice = 0;

function updatePrice(sel) {
    const opt = sel.options[sel.selectedIndex];
    currentPrice = parseFloat(opt.dataset.price || 0);
    calcTotal();
}

function calcTotal() {
    const qty   = parseInt(document.getElementById('qtyInput').value) || 0;
    const total = currentPrice * qty;
    document.getElementById('totalDisplay').textContent =
        'Rp ' + total.toLocaleString('id-ID');
}
</script>
@endpush
