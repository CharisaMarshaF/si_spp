<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Pembayaran</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #444; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h3>Riwayat Pembayaran SPP</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Bayar</th>
                <th>Petugas</th>
                <th>Nama Siswa</th>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pembayaran as $i => $p)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $p->tgl_bayar }}</td>
                <td>{{ $p->petugas->nama_petugas ?? '-' }}</td>
                <td>{{ $p->siswa->nama ?? '-' }}</td>
                <td>{{ $p->bulan_dibayar }}</td>
                <td>{{ $p->tahun_dibayar }}</td>
                <td>Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
