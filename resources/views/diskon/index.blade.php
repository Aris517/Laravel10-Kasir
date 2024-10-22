@extends('layout.app')
@section('content')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="font-weight-bold text-primary">Tabel Data Diskon</h6>
            <button class="btn btn-success btn-sm text-right" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus-square"></i> Tambah Diskon</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jumlah Harga</th>
                            <th>Diskon</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Jumlah Harga</th>
                            <th>Diskon</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($diskon as $c)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $c->jml_harga }}</td>
                                <td>{{ $c->diskon }}</td>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Diskon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/diskon/store" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Jumlah Harga</label>
                            <input type="number" class="form-control" name="jml_harga" required>
                        </div>
                        <div class="form-group">
                            <label>Diskon</label>
                            <input type="number" class="form-control" name="diskon" required>
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

    @foreach ($diskon as $c)
    <div class="modal fade" id="edit{{ $c->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Diskon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/diskon/update/{{ $c->id }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Jumlah Harga</label>
                            <input type="number" class="form-control" name="jml_harga" value="{{ $c->jml_harga }}" required>
                        </div>
                        <div class="form-group">
                            <label>Diskon</label>
                            <input type="number" class="form-control" name="diskon" value="{{ $c->diskon }}" required>
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

    @foreach ($diskon as $c)
    <div class="modal fade" id="hapus{{ $c->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Diskon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                            <label>Yakin ingin hapus diskon ini?</label>
                            <input type="text" class="form-control mb-3"value="{{ $c->jml_harga }}" disabled>
                            <input type="text" class="form-control"value="{{ $c->diskon }}" disabled>
                        </div>
                        <a href="/diskon/destroy/{{ $c->id }}" class="btn btn-danger mt-3">Hapus</a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

@endsection