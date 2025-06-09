@extends('layouts')

@section('content')
<div class="container">
    <h2>Daftar User</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user['name'] }}</td>
                <td>{{ $user['email'] }}</td>
                <td>{{ $user['created_at'] }}</td>
                <td>
                    <a href="{{ route('users.show', $user['id']) }}" class="btn btn-sm btn-primary">Lihat Transaksi</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
