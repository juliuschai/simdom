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
			name: 'domain_aktifs.id',
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
			name: 'domain_aktifs.alias',
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
			name: 'domain_aktifs.kapasitas',
			searchable: true,
			visible: true,
		},
		{
			title: 'IP',
			data: 'ip_domain',
			name: 'domain_aktifs.ip_domain',
			searchable: true,
			visible: true,
		},
		{
			title: 'Status',
			data: 'aktif',
			name: 'domain_aktifs.aktif',
			searchable: true,
			visible: true,
		},
		{
			title: 'Tanggal Rekap',
			data: 'created_at',
			name: 'domain_aktifs.created_at',
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

// Domain List search via get params
let queryString = window.location.search;
let urlParams = new URLSearchParams(queryString);
console.log(urlParams);
let urlSearch = urlParams.get('q');
console.log(urlSearch);
if (urlSearch) datatableRes.search(urlSearch).draw();
