<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\DetailInvoice;
use App\Models\Invoice;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SUController extends Controller
{
    public function kelolaAdmin()
    {
        if (auth()->user()->role != 1) {
            return redirect('/')->with('gagal', 'Mohon maaf fitur pada lvl ini tidak cukup');
        }

        $data = [
            'admin' => Admin::join('users', 'users.id', '=', 'admin.id_users')
                ->whereNotIn('users.role', [1])
                ->select('users.id as id_users', 'admin.*')
                ->latest()->get(),
            'title' => 'Kelola Admin',
        ];
        return view('admin.index', $data);
    }

    public function adminStore(Request $request)
    {
        $validatedData = $request->validate([
            'username'       => 'required|unique:users,username',
        ], [
            'username.unique' => 'Username sudah di gunakan',
        ]);

        User::create([
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'role' => 2
        ]);

        $id = User::latest()->first()->id;

        Admin::create([
            'id_users' => $id,
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
            'no_hp' => $request->input('no_hp'),
        ]);

        return redirect('/su/admin')->with('success', 'Data Admin Berhasil Disimpan');
    }

    public function adminUpdate(Request $request, $id)
    {
        Admin::where('id', $id)->update([
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
            'no_hp' => $request->input('no_hp'),
        ]);

        return redirect('/su/admin')->with('success', 'Data Admin Berhasil Diubah');
    }

    public function adminDestroy($id)
    {
        Admin::where('id_users', $id)->delete();
        User::where('id', $id)->delete();

        return redirect('/su/admin')->with('success', 'Data Admin Berhasil Dihapus');
    }

    public function laporan()
    {
        $data = [
            'title' => 'Laporan',
        ];
        return view('laporan.index', $data);
    }

    public function cetak(Request $request)
    {
        $data = [
            'invoice' => Invoice::leftJoin('diskon', 'diskon.id', '=', 'invoice.id_diskon')
                ->join('users', 'users.id', '=', 'invoice.id_users')
                ->join('admin', 'admin.id_users', '=', 'users.id')
                ->whereBetween('tgl_pembelian', [$request->input('dari'), $request->input('sampai')])
                ->select('invoice.*', 'users.id as id_users', 'admin.nama', DB::raw('IFNULL(diskon.diskon, "-") as diskon'))
                ->latest()->get(),
            'produk' => Produk::all(),
            'detail' => DetailInvoice::join('produk', 'produk.id', '=', 'detail_invoice.id_produk')->get(),
            'dari' => $request->input('dari'),
            'sampai' => $request->input('sampai'),
        ];
        return view('laporan.cetak', $data);
    }
}
