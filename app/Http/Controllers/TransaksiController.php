<?php

namespace App\Http\Controllers;

use App\Models\DetailInvoice;
use App\Models\Diskon;
use App\Models\Invoice;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Transaksi',
            'invoice' => Invoice::leftJoin('diskon', 'diskon.id', '=', 'invoice.id_diskon')
                ->join('users', 'users.id', '=', 'invoice.id_users')
                ->join('admin', 'admin.id_users', '=', 'users.id')
                ->select('invoice.*', 'users.id as id_users', 'admin.nama', DB::raw('IFNULL(diskon.diskon, "-") as diskon'))
                ->latest()->get(),
            'produk' => Produk::all(),
            'detail' => DetailInvoice::join('produk', 'produk.id', '=', 'detail_invoice.id_produk')->get(),
        ];

        return view('transaksi.index', $data);
    }

    public function store(Request $request)
    {
        $subTotal = 0;
        $k = false;
        for ($i = 1; $i <= $request->input('jml'); $i++) {
            $produk = Produk::where('id', $request->input("id$i"))->first();

            if ($request->input("jml_produk$i") <= 0) {
                return redirect('/transaksi')->with('gagal', 'Masukan kuantitas lebih dari 0');
            }

            if ($produk->stok < $request->input("jml_produk$i")) {
                return redirect('/transaksi')->with('gagal', 'Mohon maaf jumlah produk yang di beli melebihi stok');
            }



            if ($k == false) {
                Invoice::create([
                    'faktur_pembelian' => $request->input('faktur_pembelian'),
                    'id_users' => auth()->user()->id,
                ]);

                $id = Invoice::latest()->first()->id;

                $k = true;
            }
            DetailInvoice::create([
                'id_invoice' => $id,
                'id_produk' => $produk->id,
                'jml_produk' => $request->input("jml_produk$i"),
            ]);

            $produk->update(['stok' => $produk->stok - $request->input("jml_produk$i")]);

            $subTotal += ($request->input("jml_produk$i") * $produk->harga_jual);
        }

        $diskonDiambil = 0;
        $id_diskon = null;
        $diskon = Diskon::all();
        foreach ($diskon as $d) {
            if ($subTotal >= $d->jml_harga) {
                $diskonDiambil = $d->diskon;
                $id_diskon = $d->id;
            }
        }

        $total = $subTotal - $diskonDiambil;

        Invoice::where('id', $id)->update([
            'id_diskon' => $id_diskon,
            'total' => $total
        ]);

        return redirect('/transaksi')->with('success', 'Data Transaksi Berhasil Disimpan');
    }
}
