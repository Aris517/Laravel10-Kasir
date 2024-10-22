<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laporan Transaksi</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container-fluid">
            <div class="text-center">
                <h3>Laporan Transaksi</h3>
                <p>Tanggal {{ $dari}} - {{ $sampai }}</p>
            </div>
        </div>      

        <table class="table table-bordered text-center" style="font-size:12px;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Faktur</th>
                    <th>Tgl Beli</th>
                    <th>Diskon</th>
                    <th>Sub Total</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice as $i)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $i->faktur_pembelian }}</td>
                    <td>{{ $i->tgl_pembelian }}</td>
                    <td>{{ $i->diskon }}</td>
                    <td>{{ (int)$i->diskon + $i->total }}</td>
                    <td>{{ $i->total }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

        <script>
        window.print()
        window.onafterprint = function() {
            window.close();
        };
        </script>
    </body>
</html>