var serverTableElm = $('#serverTable');

var editBtn = $('#editBtnTemplate');

serverTableElm.DataTable({
	processing: true,
	serverSide: true,
	ajax: serverTableElm.data('ajaxurl'),
	columns: [
		{
			data: 'id',
			name: null,
			searchable: false,
			visible: false,
		},
		{
			title: 'Nama Server',
			data: 'nama_server',
			name: 'nama_server',
			searchable: true,
			visible: true,
		},
		{
			title: 'Tanggal Aktif',
			data: 'created_at',
			name: 'created_at',
			searchable: true,
			visible: true,
			render: function (data, type, full, meta) {
				return new Date(data).toLocaleString();
			},
		},
		{
			title: 'Lokasi Server',
			data: 'lokasi_server',
			name: 'lokasi_server',
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
				let resultHTML = '<div style="white-space: nowrap;">';
				resultHTML += editBtn.createButton(full.id).html();
				resultHTML += '</div>'
				return resultHTML;
			}
		}
	],
});
