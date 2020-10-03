<table>
    <thead>
        <tr>
            <td>Nama PIC</td>
            <td>Email PIC</td>
            <td>Integra PIC</td>
            <td>Sivitas PIC</td>
            <td>No. WA</td>
            <td>Unit</td>
            <td>Domain</td>
            <td>Alias</td>
            <td>Deskrpsi</td>
            <td>IP</td>
            <td>Tipe Server</td>
            <td>Kapasitas</td>
            <td>Status</td>
            <td>Aktif</td>
            <td>Waktu Dibuat</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
        <tr>
			<td>{{$data->u_nama}}</td>
			<td>{{$data->u_email}}</td>
			<td>{{$data->u_integra}}</td>
			<td>{{$data->u_group}}</td>
			<td>{{$data->u_no_wa}}</td>
			<td>{{$data->unit_nama}}</td>
			<td>{{$data->nama_domain}}</td>
			<td>{{$data->alias}}</td>
			<td>{{$data->deskripsi}}</td>
			<td>{{$data->ip}}</td>
			<td>{{$data->server}}</td>
			<td>{{$data->kapasitas}}</td>
			<td>{{$data->status}}</td>
			<td>{{$data->aktif}}</td>
			<td>{{$data->waktu_dibuat}}</td>
        </tr>
        @endforeach
    </tbody>
</table>