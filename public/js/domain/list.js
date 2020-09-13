// domain list datatabel setup
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
			data: 'nama_server',
			name: 'servers.nama',
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
			data: 'aktif',
			name: 'domains.aktif',
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
				return editBtn.createButton(full.id).html();
			}
		}
	],
});

// Domain List search via get params
let queryString = window.location.search;
let urlParams = new URLSearchParams(queryString);
let urlSearch = urlParams.get('q');
if (urlSearch) datatableRes.search(urlSearch).draw();
