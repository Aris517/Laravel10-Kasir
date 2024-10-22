<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $data = [
            'category' => Kategori::latest()->get(),
            'title' => 'Kategori',
        ];
        return view('kategori.index', $data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kategori'       => 'required',
        ], [
            'kategori.required' => 'Kategori harus diisi',
        ]);

        Kategori::create($validatedData);

        return redirect('/kategori')->with('success', 'Data Kategori Berhasil Disimpan');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'kategori'       => 'required',
        ], [
            'kategori.required' => 'Kategori harus diisi',
        ]);

        Kategori::where('id', $id)->update($validatedData);

        return redirect('/kategori')->with('success', 'Data Kategori Berhasil Diubah');
    }

    public function destroy($id)
    {
        Kategori::destroy($id);

        return redirect('/kategori')->with('success', 'Data Kategori Berhasil Dihapus');
    }
}
