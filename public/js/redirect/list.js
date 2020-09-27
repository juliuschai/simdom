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
			title: 'Link Lama',
			data: 'link_lama',
			name: 'link_lama',
			searchable: true,
			visible: true,
		},
		{
			title: 'Link Baru',
			data: 'link_baru',
			name: 'link_baru',
			searchable: true,
			visible: true,
		},
		{
			title: 'Keterangan',
			data: 'keterangan',
			name: 'keterangan',
			searchable: true,
			visible: true,
		},
		{
			title: 'Dibuat',
			data: 'created_at',
			name: 'created_at',
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
