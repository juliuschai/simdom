<table>
    <thead>
        <tr>
            <td>Nama PIC</td>
            <td>Email PIC</td>
            <td>Integra PIC</td>
            <td>Sivitas PIC</td>
            <td>No. WA</td>
            <td>Unit</td>
            <td>Domain Aktif</td>
            <td>Permintaan Domain</td>
            <td>Deskrpsi</td>
            <td>IP</td>
            <td>Tipe Server</td>
            <td>Kapasitas</td>
            <td>Status</td>
            <td>Keterangan</td>
            <td>Waktu Konfirmasi</td>
            <td>Waktu Selesai</td>
            <td>Lama Proses</td>
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
			<td>{{$data->domain_aktif}}</td>
			<td>{{$data->nama_domain}}</td>
			<td>{{$data->deskripsi}}</td>
			<td>{{$data->ip}}</td>
			<td>{{$data->server}}</td>
			<td>{{$data->kapasitas}}</td>
			<td>{{$data->status}}</td>
			<td>{{$data->keterangan}}</td>
			<td>{{$data->waktu_konfirmasi}}</td>
			<td>{{$data->waktu_selesai}}</td>
			<td>{{$data->lama_proses}}</td>
			<td>{{$data->waktu_dibuat}}</td>
        </tr>
        @endforeach
    </tbody>
</table>