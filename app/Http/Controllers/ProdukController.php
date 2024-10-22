<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $data = [
            'kategori' => Kategori::all(),
            'produk' => Produk::Join('kategori', 'produk.id_kategori', '=', 'kategori.id')
                ->select('produk.*', 'kategori.kategori')
                ->latest()->get(),
            'title' => 'Produk',
        ];
        return view('produk.index', $data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_produk' => 'required|unique:produk,kode_produk',
            'id_kategori' => 'required',
            'nama_produk' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stok' => 'required',
        ], [
            'kode_produk.required' => 'Kode produk harus diisi',
            'kode_produk.unique' => 'Kode produk sudah digunakan',
            'id_kategori.required' => 'Kategori harus diisi',
            'nama_produk.required' => 'Nama produk harus diisi',
            'harga_beli.required' => 'Harga beli harus diisi',
            'harga_jual.required' => 'Harga jual harus diisi',
            'stok.required' => 'Stok harus diisi',
        ]);


        Produk::create($validatedData);

        return redirect('/produk')->with('success', 'Data Produk Berhasil Disimpan');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'kode_produk'       => 'required',
            'id_kategori'       => 'required',
            'nama_produk'       => 'required',
            'harga_beli'       => 'required',
            'harga_jual'       => 'required',
            'stok'       => 'required',
        ], [
            'kode_produk.required' => 'Kode produk harus diisi',
            'id_kategori.required' => 'Kategori harus diisi',
            'nama_produk.required' => 'Nama produk harus diisi',
            'harga_beli.required' => 'Harga beli harus diisi',
            'harga_jual.required' => 'Harga jual harus diisi',
            'stok.required' => 'Stok harus diisi',
        ]);

        Produk::where('id', $id)->update($validatedData);

        return redirect('/produk')->with('success', 'Data Produk Berhasil Diubah');
    }

    public function destroy($id)
    {
        Produk::destroy($id);

        return redirect('/produk')->with('success', 'Data Produk Berhasil Dihapus');
    }
}
