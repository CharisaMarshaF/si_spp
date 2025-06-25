@extends('layouts.master')

@section('content')
<div class="page-heading">
    <h3>Riwayat Pembayaran SPP</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <span>Data Riwayat Pembayaran</span>
            <div>
                <a href="{{ route('pembayaran.export.excel') }}" class="btn btn-success">
                    <i class="fas fa-file-excel me-1"></i> Export Excel
                </a>
                <a href="{{ route('pembayaran.export.pdf') }}" class="btn btn-danger">
                    <i class="fas fa-file-pdf me-1"></i> Export PDF
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Petugas</th>
                        <th>Nama Siswa</th>
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
                        <td>{{ $r->siswa->nama ?? '-' }}</td>
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
