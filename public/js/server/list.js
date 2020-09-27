var tableElm = $('#tableElm');

var editBtn = $('#editBtnTemplate');

tableElm.DataTable({
	processing: true,
	serverSide: true,
	ajax: tableElm.data('ajaxurl'),
	columns: [
		{
			data: 'id',
			name: null,
			searchable: false,
			visible: false,
		},
		{
			title: 'Nama PIC',
			data: 'nama_user',
			name: 'users.nama',
			searchable: true,
			visible: true,
		},
		{
			title: 'Email PIC',
			data: 'email_user',
			name: 'users.email',
			searchable: true,
			visible: true,
		},
		{
			title: 'No. HP PIC',
			data: 'no_wa_user',
			name: 'users.no_wa',
			searchable: true,
			visible: true,
		},
		{
			title: 'Unit',
			data: 'nama_unit',
			name: 'units.nama',
			searchable: true,
			visible: true,
		},
		{
			title: 'Deskripsi',
			data: 'deskripsi',
			name: 'servers.deskripsi',
			searchable: true,
			visible: true,
		},
		{
			title: 'No. Rack',
			data: 'no_rack',
			name: 'servers.no_rack',
			searchable: true,
			visible: true,
		},
		{
			title: 'Dibuat',
			data: 'created_at',
			name: 'servers.created_at',
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

datatableRes.columns('domains.created_at:name').order('desc').draw();
