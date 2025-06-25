@extends('layouts.master')

@section('content')
<div class="page-heading">
    <h3>Riwayat Pembayaran Saya</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-header">Data Riwayat</div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Petugas</th>
                        <th>Tanggal Bayar</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>Jumlah Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($riwayat as $i => $r)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $r->petugas->nama_petugas ?? '-' }}</td>
                        <td>{{ $r->tgl_bayar }}</td>
                        <td>{{ $r->bulan_dibayar }}</td>
                        <td>{{ $r->tahun_dibayar }}</td>
                        <td>Rp {{ number_format($r->jumlah_bayar, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
