@extends('layouts')

@section('content')
<div class="container">
    <h2>Detail User</h2>
    <p><strong>Nama:</strong> {{ $user['name'] }}</p>
    <p><strong>Email:</strong> {{ $user['email'] }}</p>
    <p><strong>Dibuat:</strong> {{ $user['created_at'] }}</p>

    <h4>Transaksi:</h4>
    @if (count($transactions) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Jumlah Topup</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Dibuat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $trx)
                <tr>
                    <td>{{ $trx['id'] }}</td>
                    <td>{{ $trx['jumlah_topup'] }}</td>
                    <td>{{ $trx['total_harga'] }}</td>
                    <td>{{ $trx['status'] }}</td>
                    <td>{{ $trx['created_at'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada transaksi.</p>
    @endif
</div>
@endsection
