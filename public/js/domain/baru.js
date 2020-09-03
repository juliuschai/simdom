$(document).ready(function () {
	populate();
});

function populate() {
	// Set tipeServer to old input
	$tipeServer = $('#tipeServer');
	$tipeServer.val($tipeServer.data('value'));
}

function validate() {
	if (!$('#namaDomain').val()) { alert('Nama Domain tidak boleh kosong!'); return false; }
	if (!$('#surat').val()) {
		if (!confirm('Field surat koson! Apakah Anda yakin tidak memakai surat?')) {
			return false;
		}
	}
	if (!$('#kapasitas').val()) { alert('Kapasitas tidak boleh kosong!'); return false; }
	if (!$('#keterangan').val()) { alert('Keterangan tidak boleh kosong!'); return false; }
	return true;
}

function submitForm() {
	if (!validate()) { return; }
	document.getElementById('msform').submit();
}


