var tableElm = $('#tableElm');

var editBtn = $('#editBtnTemplate');

tableElm.DataTable({
	processing: true,
	serverSide: true,
	ajax: tableElm.data('ajaxurl'),
	columns: [
		{
            title: 'Id',
			data: 'id',
			name: 'id',
			searchable: false,
			visible: false,
		},
		{
			title: 'Nama',
			data: 'nama',
			name: 'nama',
			searchable: true,
			visible: true,
		},
		{
			title: 'Email',
			data: 'email',
			name: 'email',
			searchable: true,
			visible: true,
		},
		{
			title: 'Integra',
			data: 'integra',
			name: 'integra',
			searchable: true,
			visible: true,
		},
		{
			title: 'No. WA',
			data: 'no_wa',
			name: 'no_wa',
			searchable: true,
			visible: true,
		},
		{
			title: 'Sivitas',
			data: 'group',
			name: 'group',
			searchable: true,
			visible: true,
		},
		{
			title: 'Admin',
			data: 'role',
			name: 'role',
			searchable: true,
			visible: true,
		},
		{
			title: 'Notif',
			data: 'email_notification',
			name: 'email_notification',
			searchable: true,
            visible: true,
            render: function (data, type, full, meta) {
                if (data === 'true') return 'Iya';
                else return 'Tidak';
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
		},
	],
});
