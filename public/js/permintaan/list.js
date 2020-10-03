var tableElm = $('#tableElm');

var editBtn = $('#editBtnTemplate');

var datatableRes = tableElm.DataTable({
	processing: true,
	serverSide: true,
	ajax: tableElm.data('ajaxurl'),
	columns: [
		{
			title: 'Id',
			data: 'id',
			name: 'permintaans.id',
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
			name: 'permintaans.nama_domain',
			searchable: true,
			visible: true,
			render: function (data, type, full, meta) {
				if (!data) return '-';
				const res = data.replace(',', ',<br>');
				return res;
			}
		},
		{
			title: 'Jenis Domain',
			data: 'server',
			name: 'domains.server',
			searchable: true,
			visible: true,
		},
		{
			title: 'Kapasitas DB',
			data: 'kapasitas',
			name: 'permintaans.kapasitas',
			searchable: true,
			visible: true,
		},
		{
			title: 'IP Domain',
			data: 'ip',
			name: 'permintaans.ip',
			searchable: true,
			visible: true,
		},
		{
			title: 'Status',
			data: 'status',
			name: 'permintaans.status',
			searchable: true,
			visible: true,
		},
		{
			title: 'Keterangan',
			data: 'keterangan',
			name: 'permintaans.keterangan',
			searchable: true,
			visible: true,
		},
		{
			title: 'Dibuat',
			data: 'created_at',
			name: 'permintaans.created_at',
			searchable: true,
			visible: true,
			render: function (data, type, full, meta) {
				return new Date(data).toLocaleString();
			},
		},
		{
			title: 'Aksi',
			data: null,
			name: null,
			searchable: false,
			visible: true,
			render: function (data, type, full, meta) {
				return editBtn.createButton(full.id).html();
			}
		}
	],
});

datatableRes.columns('permintaans.created_at:name').order('desc').draw();