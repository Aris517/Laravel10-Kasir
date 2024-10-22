@extends('layout.app')
@section('content')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="font-weight-bold text-primary">Tabel Data Produk</h6>
            <button class="btn btn-success btn-sm text-right" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus-square"></i> Tambah Produk</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Name</th>
                            <th>Kategori</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Stok</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Name</th>
                            <th>Kategori</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Stok</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($produk as $c)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $c->kode_produk }}</td>
                                <td>{{ $c->nama_produk }}</td>
                                <td>{{ $c->kategori }}</td>
                                <td>{{ $c->harga_beli }}</td>
                                <td>{{ $c->harga_jual }}</td>
                                <td>{{ $c->stok }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit{{ $c->id }}"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapus{{ $c->id }}"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/produk/store" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Kode</label>
                            <input type="text" class="form-control" name="kode_produk" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Produk</label>
                            <input type="text" class="form-control" name="nama_produk" required>
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <div class="input-group mb-3">
                            <select class="custom-select" id="kategori" name="id_kategori" required>
                                <option>Choose...</option>
                                @foreach ($kategori as $k)
                                <option value="{{ $k->id}}">{{ $k->kategori }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Harga Beli</label>
                                    <input type="number" class="form-control" name="harga_beli" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Harga Jual</label>
                                    <input type="number" class="form-control" name="harga_jual" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Harga Stok</label>
                                    <input type="number" class="form-control" name="stok" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @foreach ($produk as $c)
    <div class="modal fade" id="edit{{ $c->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/produk/update/{{ $c->id }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Kode</label>
                            <input type="text" class="form-control" name="kode_produk" value="{{ $c->kode_produk}}" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Produk</label>
                            <input type="text" class="form-control" name="nama_produk" value="{{ $c->nama_produk}}" required>
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <div class="input-group mb-3">
                            <select class="custom-select" id="kategori" name="id_kategori" required>
                                <option>Choose...</option>
                                @foreach ($kategori as $k)
                                <option value="{{ $k->id}}" {{ ($k->id == $c->id_kategori) ? "selected" : ""}}>{{ $k->kategori }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Harga Beli</label>
                                    <input type="number" class="form-control" name="harga_beli" value="{{ $c->harga_beli }}" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Harga Jual</label>
                                    <input type="number" class="form-control" name="harga_jual" value="{{ $c->harga_jual }}" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Harga Stok</label>
                                    <input type="number" class="form-control" name="stok" value="{{ $c->stok }}" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @foreach ($produk as $c)
    <div class="modal fade" id="hapus{{ $c->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                            <label>Yakin ingin hapus produk ini?</label>
                            <input type="text" class="form-control mb-2" value="{{ $c->kode_produk }}" readonly>
                            <input type="text" class="form-control" value="{{ $c->nama_produk }}" readonly>
                        </div>
                        <a href="/produk/destroy/{{ $c->id }}" class="btn btn-danger mt-3">Hapus</a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

@endsection