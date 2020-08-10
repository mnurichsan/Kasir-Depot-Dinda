<table>
    <thead>
    <tr>
        <th>No.</th>
        <th>Tanggal</th>
        <th>Alamat</th>
        <th>Nama Barang</th>
        <th>Harga Barang</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($transaksi as $tra => $t)
        <tr>
            <td>{{$tra + 1}}</td>
            <td>{{ $t->created_at->format('d M Y') }}</td>
            <td>{{ $t->alamat }}</td>
            <td>{{$t->barang->namabarang}}</td>
            <td>{{$t->barang->hargabarang}}</td>
            <td>{{$t->total_harga}}</td>
        </tr>
    @endforeach
    </tbody>
</table>