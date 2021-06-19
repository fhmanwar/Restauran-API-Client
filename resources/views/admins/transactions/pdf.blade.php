<html>
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>

	<div class="text-center">
		<h5>PIEZO PONDOK KELAPA</h5>
        <span>
            Jl. Pd. Kelapa Raya, RT.11/RW.9, Pd. Kopi, Kec. Duren Sawit, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13450<br>
            Telp. +62822 1814 2820  || E-mail piezocoffe00@gmail.com
        </span>
    </div>
    <br><br>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="">
                        <tr>
                            <th style="width: 20%"> Nama Pelanggan </th>
                            <td> : {{ $order->Name }} </td>
                        </tr>
                        <tr>
                            <th> Time Order </th>
                            <td> : {{ $order->OrderTime }} </td>
                        </tr>
                        <tr>
                            <th> table number </th>
                            <td> : {{ $order->noMeja }} </td>
                        </tr>
                    </table>
                    <hr>
                    <table class="table">
                        <thead>
                            <tr class="text-center">
                                <th>Menu</th>
                                <th>Harga</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detail as $row)
                                @if ($loop->iteration == 0)
                                    <tr>
                                        <td colspan="5">Data kosong</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>{{ $row->nama_masakan }}</td>
                                        <td class="text-right">{{ $row->Qty }} X @Rp {{ number_format($row->harga, 2, ',', '.') }}</td>
                                        <td class="text-right">Rp {{ number_format($row->SubTotal, 2, ',', '.') }}</td>
                                    </tr>
                                @endif
                            @endforeach
                            <tr>
                                <td colspan="2" class="text-center"><strong>Total</strong></td>
                                <td class="text-right"><strong>Rp {{ number_format($order->Total, 2, ',', '.') }}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center"><strong>Uang Bayar</strong></td>
                                <td class="text-right"><strong>Rp {{ number_format($order->Bayar, 2, ',', '.') }}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center"><strong>Uang Kembalian</strong></td>
                                <td class="text-right"><strong>Rp {{ number_format($order->Kembali, 2, ',', '.') }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <br><br><br>
    <br><br><br>
    <footer class="text-center"> <h5> THANKS FOR YOUR VISIT </h5> </footer>

</body>
</html>
