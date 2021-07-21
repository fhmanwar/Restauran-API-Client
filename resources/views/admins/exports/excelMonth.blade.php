<table>
    <thead>
        <tr>
            <td colspan="5">Laporan Keuangan Bulan {{ $mth }}</td>
        </tr>
        <tr>
            <td colspan="5">Periode {{ $period }}</td>
        </tr>
        <tr></tr>
        <tr>
            <th>#</th>
            <th>Nama Product</th>
            <th>Jumlah Pesanan</th>
            <th>Harga</th>
        </tr>
    </thead>
    <tbody>
        @php
            $total = 0;
            $jmlTransaksi = 0;
        @endphp
        @foreach($data as $row)
        <tr>
            <td>{{ $row->id_masakan }}</td>
            <td>{{ $row->nama_masakan }}</td>
            <td>{{ $row->Quantity }}</td>
            <td>{{ $row->Total }}</td>
        </tr>
        @php
            $total += $row->Total;
            $jmlTransaksi += $row->Quantity;
        @endphp
        @endforeach
        <tr></tr>
        <tr>
            <td colspan="3">Total Pemasukan</td>
            <td>{{ $total }}</td>
        </tr>
        <tr>
            <td colspan="3">Jumlah Transaksi</td>
            <td>{{ $jmlTransaksi }}</td>
        </tr>
    </tbody>
</table>
