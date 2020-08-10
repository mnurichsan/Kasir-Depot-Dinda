<table>
    <thead>
    <tr>
        <th>No.</th>
        <th>Kode Setoran</th>
        <th>Tanggal Setoran</th>
        <th>Pegawai</th>
        <th>Total Bayar</th>
        <th>Total Setoran</th>
        <th>Kembalian</th>
    </tr>
    </thead>
    <tbody>
    @foreach($setoran as $se => $s)
        <tr>
            <td>{{$se + 1}}</td>
            <td>{{$s->kode_setoran}}</td>
            <td>{{$s->tanggal_setoran->format('d M Y')}}</td>
            <td>{{$s->pegawai->nama}}</td>
            <td>{{$s->total_bayar}}</td>
            <td>{{$s->total_setoran}}</td>
            <td>{{$s->kembalian}}</td>
        </tr>
    @endforeach
    </tbody>
</table>