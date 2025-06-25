<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = Petugas::all();
        return view('petugas.petugas', compact('petugas'))->with('header_title', 'Data Petugas');
    }

    public function store(Request $request)
{
    $request->validate([
        'nama_petugas' => 'required',
        'username' => 'required|unique:user,username',
        'password' => 'required|min:6',
        'level' => 'required|in:admin,petugas'
    ]);


    $petugas = Petugas::create(['nama_petugas' => $request->nama_petugas]);

    User::create([
        'id_petugas' => $petugas->id,
        'username' => $request->username,
        'password' => Hash::make($request->password),
        'level' => $request->level
    ]);

    return redirect()->route('petugas.index')->with('success', 'Data petugas berhasil ditambahkan.');
}


public function update(Request $request, $id_petugas)
{
    // Validasi data yang masuk
    $request->validate([
        'nama_petugas' => 'required|string|max:255',
        'username' => 'nullable|string|unique:user,username,' . $request->id_user,
        'password' => 'nullable|min:6',
        'level' => 'required|in:admin,petugas'
    ]);

    // Cari petugas berdasarkan id_petugas
    $petugas = Petugas::findOrFail($id_petugas);

    // Update data petugas
    $petugas->nama_petugas = $request->nama_petugas;
    $petugas->save();

    // Cari user yang terkait dengan petugas ini
    $user = $petugas->user;  // Relasi hasOne, jadi kita ambil user yang terkait

    if ($user) {
        // Jika user ditemukan, update data user
        $user->username = $request->username ?? $user->username;
        $user->level = $request->level ?? $user->level;

        // Jika password diisi, update password
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        // Simpan perubahan user
        $user->save();
    } else {
        // Jika tidak ada user terkait, buat user baru
        User::create([
            'id_petugas' => $petugas->id,
            'username' => $request->username,
            'password' => $request->password ? Hash::make($request->password) : null,
            'level' => $request->level
        ]);
    }

    return redirect()->route('petugas.index')->with('success', 'Data petugas dan user berhasil diperbarui.');
}



public function destroy($id_petugas)
{
    // Cari petugas berdasarkan id_petugas
    $petugas = Petugas::findOrFail($id_petugas);
    
    // Pastikan petugas memiliki user yang terkait dan hapus user terkait
    if ($petugas->user) {
        $petugas->user->delete();  // Hapus data user terkait
    }

    // Hapus data petugas
    $petugas->delete();

    // Redirect kembali ke halaman petugas dengan pesan sukses
    return redirect()->route('petugas.index')->with('success', 'Data petugas berhasil dihapus.');
}


    
}
