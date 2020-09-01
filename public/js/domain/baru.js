function pz(str) {
	return ("0" + str).slice(-2);
}

$(document).ready(function () {
	populate();
});

function populate() {
	// Set tipeServer to old input
	$tipeServer = $('#tipeServer');
	console.log($tipeServer.data('value'));
	$tipeServer.val($tipeServer.data('value'));
	console.log($tipeServer.val());
}

function validate() {
	// TODO:
}

/**
 * returns true if waktu is valid
 */
function validateWaktu() {
	let beginDates = [], endDates = [];

	let $begins = $('.domainTimesForm').find('.waktuMulai');
	$begins.each(function (i, elm) {
		beginDates.push(new Date($(this).val()));
	});
	let $ends = $('.domainTimesForm').find('.waktuSelesai');
	$ends.each(function (i, elm) {
		endDates.push(new Date($(this).val()));
	});

	for (let i = 0; i < beginDates.length; i++) {
		const beginDate = beginDates[i];
		const endDate = endDates[i];

		if (beginDate <= new Date()) {
			alert('Waktu mulai tidak bisa diletakkan di masa lalu!');
			return false;
		}

		let diff = (endDate.getTime() - beginDate.getTime()) / 60 / 1000;
		if (diff < 30) {
			alert('Durasi harus lebih dari 30 menit!');
			return false;
		}
	}

	return true;
}

function submitForm() {
	if (validateOtherFields() && validateWaktu()) {
		document.getElementById('msform').submit();
	}
}


