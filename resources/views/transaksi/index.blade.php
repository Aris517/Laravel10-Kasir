@extends('layout.app')
@section('content')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="font-weight-bold text-primary">Tabel Data Transaksi</h6>
            <button class="btn btn-success btn-sm text-right" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus-square"></i> Tambah Transaksi</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Faktur</th>
                            <th>Tanggal Pembelian</th>
                            <th>Diskon</th>
                            <th>Total</th>
                            <th>admin</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Faktur</th>
                            <th>Tanggal Pembelian</th>
                            <th>Diskon</th>
                            <th>Total</th>
                            <th>admin</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($invoice as $c)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $c->faktur_pembelian }}</td>
                                <td>{{ $c->tgl_pembelian }}</td>
                                <td>{{ $c->diskon }}</td>
                                <td>{{ $c->total }}</td>
                                <td>{{ $c->nama }}</td>
                                <td>
                                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#detail{{ $c->id }}"><i class="fas fa-eye"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @foreach ($invoice as $i)
    <div class="modal fade" id="detail{{ $i->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Faktur Pembelian</label>
                        <input type="text" class="form-control" name="faktur_pembelian" value="{{ $i->faktur_pembelian }}" disabled>
                    </div>
                    @foreach ($detail as $d)
                        @if ($i->id == $d->id_invoice)
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Kode Produk</label>
                                        <input type="text" class="form-control" value="{{ $d->kode_produk }}" disabled>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Jumlah Produk</label>
                                        <input type="text" class="form-control" value="{{ $d->jml_produk }}" disabled>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/transaksi/store" id="formProduk" method="post">
                        <input type="hidden" name="jml" value="1">
                        @csrf
                        <div class="form-group">
                            <label>Faktur Pembelian</label>
                            <input type="text" class="form-control" name="faktur_pembelian" value="{{ 'KRO' . date('Ymd') . random_int(100000, 999999) }}" readonly>
                        </div>
                        <div id="inputan">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Kode Produk</label>
                                        <div class="input-group mb-3">
                                        <select class="custom-select" name="id1" required>
                                            <option value="">Choose...</option>
                                            @foreach ($produk as $k)
                                            <option value="{{ $k->id }}">{{ $k->kode_produk }}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Jumlah</label>
                                        <input type="number" class="form-control" name="jml_produk1" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="tambahInput()"><i class="fas fa-plus-square"></i> Produk</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<script>
let i = 1;

function tambahInput() {
    var form = $("#inputan");

    html = `
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Kode Produk</label>
                        <div class="input-group mb-3">
                        <select class="custom-select" name="id${i + 1}" required>
                            <option value="">Choose...</option>
                            @foreach ($produk as $k)
                            <option value="{{ $k->id }}">{{ $k->kode_produk }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" class="form-control" name="jml_produk${i + 1}" required>
                    </div>
                </div>
            </div>
        `;

    form.append(html);
    
    let = i += 1;
    $(`input[name='jml']`).val(i);
}

</script>

@endsection