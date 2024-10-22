<?php

namespace App\Http\Controllers;

use App\Models\Diskon;
use Illuminate\Http\Request;

class DiskonController extends Controller
{
    public function index()
    {
        $data = [
            'diskon' => Diskon::latest()->get(),
            'title' => 'Diskon',
        ];
        return view('diskon.index', $data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'jml_harga' => 'required',
            'diskon' => 'required',
        ], [
            'jml_harga.required' => 'Jumlah harga harus diisi',
            'diskon.required' => 'Diskon harus diisi',
        ]);

        Diskon::create($validatedData);

        return redirect('/diskon')->with('success', 'Data Diskon Berhasil Disimpan');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'jml_harga' => 'required',
            'diskon' => 'required',
        ], [
            'jml_harga.required' => 'Jumlah harga harus diisi',
            'diskon.required' => 'Diskon harus diisi',
        ]);

        Diskon::where('id', $id)->update($validatedData);

        return redirect('/diskon')->with('success', 'Data Diskon Berhasil Diubah');
    }

    public function destroy($id)
    {
        Diskon::destroy($id);

        return redirect('/diskon')->with('success', 'Data Diskon Berhasil Dihapus');
    }
}
