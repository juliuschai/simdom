<table>
    <thead>
        <tr>
            <td>Link Lama</td>
            <td>Link Baru</td>
            <td>Keterangan</td>
            <td>Waktu Dibuat</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
        <tr>
			<td>{{$data->link_lama}}</td>
			<td>{{$data->link_baru}}</td>
			<td>{{$data->keterangan}}</td>
			<td>{{$data->waktu_dibuat}}</td>
        </tr>
        @endforeach
    </tbody>
</table>