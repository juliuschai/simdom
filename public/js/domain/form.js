$(document).ready(function () {
	populate();
});

function populate() {
	// Set serverDomain to old input
	$serverDomain = $('#serverDomain');
	$serverDomain.val($serverDomain.data('value'));
}

function validate() {
	if (!$('#deskripsi').val()) { alert('Deskripsi Domain tidak boleh kosong!'); return false; }
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


