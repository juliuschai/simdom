// domain list datatabel setup
var tableElm = $('#tableElm');

var editBtn = $('#editBtnTemplate');
var nonaktifasiBtn = $('#nonaktifasiBtnTemplate');
var aktifasiBtn = $('#aktifasiBtnTemplate');

var datatableRes = tableElm.DataTable({
	processing: true,
	serverSide: true,
	ajax: tableElm.data('ajaxurl'),
	columns: [
		{
			title: 'Id',
			data: 'id',
			name: 'domains.id',
			searchable: false,
			visible: false,
		},
		{
			title: 'Nama PIC',
			data: 'user_nama',
			name: 'users.nama',
			searchable: true,
			visible: true,
		},
		{
			title: 'Instansi',
			data: 'unit_nama',
			name: 'units.nama',
			searchable: true,
			visible: true,
		},
		{
			title: 'Domain',
			data: 'alias',
			name: 'domains.alias',
			searchable: true,
			visible: true,
			render: function (data, type, full, meta) {
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
			name: 'domains.kapasitas',
			searchable: true,
			visible: true,
		},
		{
			title: 'IP',
			data: 'ip',
			name: 'domains.ip',
			searchable: true,
			visible: true,
		},
		{
			title: 'Status',
			data: 'status',
			name: 'domains.status',
			searchable: true,
			visible: true,
		},
		{
			title: 'Aktif',
			data: 'aktif',
			name: 'domains.aktif',
			searchable: true,
			visible: true,
		},
		{
			title: 'Dibuat',
			data: 'created_at',
			name: 'domains.created_at',
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
				let res = '<div style="white-space: nowrap;">';
				res += editBtn.createButton(full.id).html();
				if (full.aktif === 'aktif') {
					res += nonaktifasiBtn.createButton(full.id).html();
				} else {
					res += aktifasiBtn.createButton(full.id).html();
				}
				res += '</div>';
				return res;
			}
		}
	],
});

datatableRes.columns('domains.created_at:name').order('desc').draw();
