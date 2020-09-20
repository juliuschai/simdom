var tableElm = $('#tableElm');

var editButton = $('#editBtnTemplate');

tableElm.DataTable({
	processing: true,
	serverSide: true,
	ajax: tableElm.data('ajaxurl'),
	columns:[
		{
			title: 'Id',
			data: 'id',
			name: 'units.id',
			searchable: false,
			visible: false,
		},
		{
			title: 'Nama',
			data: 'nama',
			name: 'units.nama',
			searchable: true,
			visible: true,
		},
		{
			title: 'Tipe',
			data: 'tipe_unit',
			name: 'tipe_units.nama',
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
				return editButton.createButton(full.id).html();
			}
		},
	],
});
