<?php

namespace App\Http\Controllers;

use App\Models\Spp;
use Illuminate\Http\Request;

class SppController extends Controller
{

        public function index()
    {
        $spps = Spp::all();
        return view('spp.spp', compact('spps'))->with('header_title', 'Data SPP');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|string|max:255',
            'nominal' => 'required|numeric',
        ]);

        Spp::create($request->all());

        return redirect()->route('spp.index')->with('success', 'Data SPP berhasil ditambahkan.');
    }

    public function update(Request $request, Spp $spp)
    {
        $request->validate([
            'tahun' => 'required|string|max:255',
            'nominal' => 'required|numeric',
        ]);

        $spp->update($request->all());

        return redirect()->route('spp.index')->with('success', 'Data SPP berhasil diperbarui.');
    }

    public function destroy(Spp $spp)
    {
        $spp->delete();

        return redirect()->route('spp.index')->with('success', 'Data SPP berhasil dihapus.');
    }
}