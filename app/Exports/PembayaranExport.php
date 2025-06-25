<?php

namespace App\Exports;

use App\Models\Pembayaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PembayaranExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Pembayaran::with('petugas', 'siswa')->get()->map(function ($p) {
            return [
                $p->tgl_bayar,
                $p->petugas->nama_petugas ?? '-',
                $p->siswa->nama ?? '-',
                $p->bulan_dibayar,
                $p->tahun_dibayar,
                $p->jumlah_bayar,
            ];
        });
    }

    public function headings(): array
    {
        return ['Tanggal Bayar', 'Petugas', 'Nama Siswa', 'Bulan', 'Tahun', 'Jumlah Bayar'];
    }
}
