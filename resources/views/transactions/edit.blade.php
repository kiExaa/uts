@extends('layouts.app')
@section('title', 'Edit Transaksi')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Transaksi</h1>
    <a href="{{ route('transactions.index') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left mr-1"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('transactions.update', $transaction) }}" method="POST">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Pelanggan <span class="text-danger">*</span></label>
                        <input type="text" name="customer_name"
                               class="form-control @error('customer_name') is-invalid @enderror"
                               value="{{ old('customer_name', $transaction->customer_name) }}">
                        @error('customer_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tanggal Transaksi <span class="text-danger">*</span></label>
                        <input type="date" name="transaction_date"
                               class="form-control @error('transaction_date') is-invalid @enderror"
                               value="{{ old('transaction_date', \Carbon\Carbon::parse($transaction->transaction_date)->format('Y-m-d')) }}">
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
                            @foreach($products as $product)
                                <option value="{{ $product->id }}"
                                        data-price="{{ $product->price }}"
                                        {{ old('product_id', $transaction->product_id) == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }} (Rp {{ number_format($product->price, 0, ',', '.') }})
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
                               value="{{ old('quantity', $transaction->quantity) }}" min="1"
                               onchange="calcTotal()">
                        @error('quantity') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control">
                            <option value="pending" {{ old('status', $transaction->status)=='pending' ? 'selected' : '' }}>Pending</option>
                            <option value="success" {{ old('status', $transaction->status)=='success' ? 'selected' : '' }}>Sukses</option>
                            <option value="cancelled" {{ old('status', $transaction->status)=='cancelled' ? 'selected' : '' }}>Batal</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="alert alert-info">
                <strong>Total Harga: </strong>
                <span id="totalDisplay">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</span>
            </div>

            <hr>
            <button type="submit" class="btn btn-warning">
                <i class="fas fa-save mr-1"></i> Update Transaksi
            </button>
            <a href="{{ route('transactions.index') }}" class="btn btn-light">Batal</a>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
let currentPrice = parseFloat(
    document.querySelector('#productSelect option:checked')?.dataset.price || 0
);

function updatePrice(sel) {
    currentPrice = parseFloat(sel.options[sel.selectedIndex].dataset.price || 0);
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
