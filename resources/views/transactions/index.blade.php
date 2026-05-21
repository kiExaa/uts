@extends('layouts.app')
@section('title', 'Transaksi')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Daftar Transaksi</h1>
    <a href="{{ route('transactions.create') }}" class="btn btn-primary btn-sm shadow-sm">
        <i class="fas fa-plus fa-sm mr-1"></i> Catat Transaksi
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Pelanggan</th>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th>Qty</th>
                        <th>Total Harga</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $trx)
                    <tr>
                        <td>{{ $transactions->firstItem() + $loop->index }}</td>
                        <td>{{ $trx->customer_name }}</td>
                        <td>{{ $trx->product->name ?? '-' }}</td>
                        <td>
                            <span class="badge badge-info">
                                {{ $trx->product->category->name ?? '-' }}
                            </span>
                        </td>
                        <td class="text-center">{{ $trx->quantity }}</td>
                        <td><strong>Rp {{ number_format($trx->total_price, 0, ',', '.') }}</strong></td>
                        <td>{{ \Carbon\Carbon::parse($trx->transaction_date)->format('d/m/Y') }}</td>
                        <td>
                            @if($trx->status == 'success')
                                <span class="badge badge-success">Sukses</span>
                            @elseif($trx->status == 'pending')
                                <span class="badge badge-warning">Pending</span>
                            @else
                                <span class="badge badge-danger">Batal</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('transactions.edit', $trx) }}"
                               class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('transactions.destroy', $trx) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin hapus transaksi ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted">Belum ada transaksi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $transactions->links() }}
    </div>
</div>
@endsection
