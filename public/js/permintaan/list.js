var permintaanTableElm = $('#permintaanTable');

var editBtn = $('#editBtnTemplate');

permintaanTableElm.DataTable({
	processing: true,
	serverSide: true,
	ajax: permintaanTableElm.data('ajaxurl'),
	columns: [
		{
			title: 'Id',
			data: 'id',
			name: 'sejarah_domains.id',
			searchable: false,
			visible: false,
		},
		{
			title: 'Nama PJ',
			data: 'user_nama',
			name: 'users.nama',
			searchable: true,
			visible: true,
		},
		{
			title: 'Nama Instansi',
			data: 'unit_nama',
			name: 'units.nama',
			searchable: true,
			visible: true,
		},
		{
			title: 'Nama Domain',
			data: 'nama_domain',
			name: 'sejarah_domains.nama_domain',
			searchable: true,
			visible: true,
			render: function (data, type, full, meta) {
				const res = data.replace(',', ',<br>');
				return res;
			}
		},
		{
			title: 'Jenis Domain',
			data: 'nama_server',
			name: 'tipe_servers.nama_server',
			searchable: true,
			visible: true,
		},
		{
			title: 'Kapasitas DB',
			data: 'kapasitas',
			name: 'sejarah_domains.kapasitas',
			searchable: true,
			visible: true,
		},
		{
			title: 'IP Domain',
			data: 'ip_domain',
			name: 'sejarah_domains.ip_domain',
			searchable: true,
			visible: true,
		},
		{
			title: 'Status',
			data: 'status',
			name: 'sejarah_domains.status',
			searchable: true,
			visible: true,
		},
		{
			title: 'Keterangan',
			data: 'keterangan',
			name: 'sejarah_domains.keterangan',
			searchable: true,
			visible: true,
		},
		{
			title: 'Aksi',
			data: null,
			name: null,
			searchable: false,
			visible: true,
			render: function (data, type, full, meta) {
				let resultHTML = '<div style="white-space: nowrap;">'
				resultHTML += editBtn.createButton(full.id).html();
				resultHTML += '</div>'
				return resultHTML;
			}
		}
	],
});
