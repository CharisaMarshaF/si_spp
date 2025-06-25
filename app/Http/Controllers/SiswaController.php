<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Spp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::with('kelas', 'spp')->get();
        $kelas = Kelas::all();
        $spps = Spp::all();
        return view('siswa.siswa', compact('siswas', 'kelas', 'spps'))->with('header_title', 'Data Siswa');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|unique:siswa,nisn|unique:user,nisn',
            'nis' => 'required',
            'nama' => 'required',
            'id_kelas' => 'required',
            'id_spp' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
        ]);

        Siswa::create($request->all());

        User::create([
            'username' => strtolower(str_replace(' ', '_', $request->nama)), // username dari nama
            'password' => Hash::make($request->nisn), // password dari nisn
            'nisn' => $request->nisn,
            'level' => 'siswa'
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function update(Request $request, $nisn)
    {
        $request->validate([
            'nis' => 'required',
            'nama' => 'required',
            'id_kelas' => 'required',
            'id_spp' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'nisn' => 'required'
        ]);

        $siswa = Siswa::where('nisn', $nisn)->first();

        if ($siswa) {
            $siswa->update([
                'nisn' => $request->nisn,
                'nis' => $request->nis,
                'nama' => $request->nama,
                'id_kelas' => $request->id_kelas,
                'id_spp' => $request->id_spp,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
            ]);

            $user = User::where('nisn', $nisn)->first();
            if ($user) {
                $user->update([
                    'nisn' => $request->nisn,
                    'username' => strtolower(str_replace(' ', '_', $request->nama)),
                ]);
            }

            return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
        }

        return redirect()->route('siswa.index')->with('error', 'Data siswa tidak ditemukan.');
    }

    public function destroy($nisn)
    {
        $siswa = Siswa::where('nisn', $nisn)->first();

        if ($siswa) {
            User::where('nisn', $nisn)->delete();
            $siswa->delete();

            return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
        }

        return redirect()->route('siswa.index')->with('error', 'Siswa tidak ditemukan.');
    }
}
