@extends('layout.app')
@section('content')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="font-weight-bold text-primary">Laporan</h6>
        </div>
        <div class="card-body">
            <form class="col-lg-6" action="/su/cetak" target="_blank" method="post">
                @csrf
                <div class="form-group">
                    <label>Dari Tanggal</label>
                    <input type="date" class="form-control" name="dari">
                </div>
                <div class="form-group">
                    <label>Sampai Tanggal</label>
                    <input type="date" class="form-control" name="sampai">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

@endsection