var domainTableElm = $('#domainTable');
// Setup - add a text input to each footer cell
// var types = domainTableElm.data('types');
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

domainTableElm.DataTable({
	processing: true,
	serverSide: true,
	ajax: domainTableElm.data('ajaxurl'),
	deferLoading: domainTableElm.data("length"),
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
			"title": "Nama PJ",
			"data": "name_pj",
			"name": "name_pj",
			"searchable": true,
			"visible": true,
		},
		{
			"targets": 2,
			"title": "Nama Instansi",
			"data": "name_ins",
			"name": "name_ins",
			"searchable": true,
			"visible": true,
		},
		{
			"targets": 3,
			"title": "No Telepon",
			"data": "no_tlp",
			"name": "no_tlp",
			"searchable": true,
			"visible": true,
		},
		{
			"targets": 4,
			"title": "Nama Domain",
			"data": "name_domain",
			"name": "name_domain",
			"searchable": true,
			"visible": true,
		},
		{
			"targets": 5,
			"title": "Jenis Domain",
			"data": "jenis_domain",
			"name": "jenis_domain",
			"searchable": true,
			"visible": true,
		},
		{
			"targets": 6,
			"title": "Kapasitas DB",
			"data": "kp_sekarang",
			"name": "kp_sekarang",
			"searchable": true,
			"visible": true,
		},
		{
			"targets": 7,
			"title": "IP Domain",
			"data": "ip_domain",
			"name": "ip_domain",
			"searchable": true,
			"visible": true,
		},
		{
			"targets": 8,
			"title": "Tanggal Rekap",
			"data": "tgl_input",
			"name": "tgl_input",
			"searchable": true,
			"visible": true,
		},
		{
			"targets": 9, 
			"title": "Aksi",
			"data": null,
			"name": null,
			"searchable": false,
			"visible": true,
			"render": function (data, type, full, meta) {
				// console.log(data);
				// console.log(full.id);
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