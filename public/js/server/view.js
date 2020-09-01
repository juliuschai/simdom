var serverTableElm = $('#serverTable');
// Setup - add a text input to each footer cell
// var types = serverTableElm.data('types');
// $.each(types, function() {
// 	$('#searchTypeSelect')
// 		.append($("<option></option>")
// 		.val(this.id)
// 		.text(this.nama));
// });

// DataTable
// var editButton = $('#editBtnTemplate');
// var deleteButton = $('#deleteBtnTemplate');

var viewBtn = $('#viewBtnTemplate');
var editBtn = $('#editBtnTemplate');
var delBtn = $('#delBtnTemplate');

serverTableElm.DataTable({
	processing: true,
	serverSide: true,
	ajax: serverTableElm.data('ajaxurl'),
	deferLoading: serverTableElm.data("length"),
	columnDefs:[
		{
			"targets": 0,
			"data": "id",
			"name": null,
			"searchable": false,
			"visible": false,
		},
		{
			"targets": 1,
			"title": "Nama Server",
			"data": "nama_server",
			"name": "nama_server",
			"searchable": true,
			"visible": true,
		},
		{
			"targets": 2,
			"title": "Tipe Server",
			"data": "type_server",
			"name": "type_server",
			"searchable": true,
			"visible": true,
		},
		{
			"targets": 3,
			"title": "Tanggal Aktif",
			"data": "tgl_aktif",
			"name": "tgl_aktif",
			"searchable": true,
			"visible": true,
		},
		{
			"targets": 4,
			"title": "Lokasi Server",
			"data": "lokasi_server",
			"name": "lokasi_server",
			"searchable": true,
			"visible": true,
		},
		{
			"targets": 5,
			"title": "No Rack",
			"data": "no_rack",
			"name": "no_rack",
			"searchable": true,
			"visible": true,
		},
		{
			"targets": 6, 
			"title": "Aksi",
			"data": null,
			"name": null,
			"searchable": false,
			"visible": true,
			"render": function (data, type, full, meta) {
				let resultHTML = '<div style="white-space: nowrap;">'
					resultHTML += viewBtn.createButton(full.id).html();
					resultHTML += editBtn.createButton(full.id).html();
					resultHTML += delBtn.createButton(full.id).html();
				resultHTML += '</div>'
				return resultHTML;
			}
		}
	],
	initComplete: function () {
		// Apply the search
		this.api().columns().every( function () {
			var column = this;
			$('input', this.footer()).on('keyup change clear', $.debounce(250, true, function(e) {
				if (column.search() !== this.value) {
					column.search(this.value).draw();
				}
			}));

			$('select', this.footer()).on('change', function () {
				// let val = $.fn.dataTable.util.escapeRegex($(this).val());
				let val = $(this).val();
				// column.search( val ? '^'+val+'$' : '', true, false ).draw();
				column.search(val, false, false, true).draw();
			});
		});
	}
});

// function checkEmpty() {
// 	let unitTypeSelElm = document.getElementById('unitType');
// 	if (unitTypeSelElm.value == "") {
// 		alert("Mohon pilih tipe unit");
// 		return;
// 	}
// 	document.getElementById('submitForm').submit();

// }