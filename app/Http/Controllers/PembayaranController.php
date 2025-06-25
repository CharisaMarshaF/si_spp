<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PembayaranExport;
use PDF;

class PembayaranController extends Controller
{

    public function index()
    {
        $pembayaran = Pembayaran::with(['petugas', 'siswa', 'spp'])->get();
        $siswa = Siswa::all();
        return view('pembayaran.pembayaran', [
            'header_title' => 'Data Pembayaran',
            'pembayaran' => $pembayaran,
            'siswa' => $siswa
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|exists:siswa,nisn',
            'bulan_dibayar' => 'required',
            'tahun_dibayar' => 'required',
        ]);

        $siswa = Siswa::where('nisn', $request->nisn)->first();
        $jumlah_bayar = optional($siswa->spp)->nominal ?? 0;

        Pembayaran::create([
            'id_petugas' => Auth::user()->id_petugas,
            'id_spp' => $siswa->id_spp,
            'nisn' => $request->nisn,
            'tgl_bayar' => now(),
            'bulan_dibayar' => $request->bulan_dibayar,
            'tahun_dibayar' => $request->tahun_dibayar,
            'jumlah_bayar' => $jumlah_bayar,
        ]);

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil disimpan.');
    }
    
    public function destroy($id)
    {
        Pembayaran::findOrFail($id)->delete();
        return redirect()->route('pembayaran.index')->with('success', 'Data berhasil dihapus.');
    }

    public function riwayat()
    {
        $riwayat = Pembayaran::with('petugas', 'siswa')->get();
        return view('pembayaran.riwayat', compact('riwayat'));
    }
    

    public function exportExcel()
    {
        return Excel::download(new PembayaranExport, 'riwayat_pembayaran.xlsx');
    }

    public function exportPDF()
    {
        $pembayaran = Pembayaran::with('petugas', 'siswa')->get();
        $pdf = PDF::loadView('pembayaran.riwayat_pdf', compact('pembayaran'));
        return $pdf->stream('riwayat_pembayaran.pdf');
    }

    public function riwayatSiswa()
{
    $nisn = Auth::user()->nisn;
    $riwayat = Pembayaran::with(['petugas', 'siswa'])
                ->where('nisn', $nisn)
                ->get();

    return view('pembayaran.riwayat_siswa', compact('riwayat'));
}

}
