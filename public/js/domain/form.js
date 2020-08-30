/**
 * Populates the selects that exists in the page
 */
(function populateSelects() {
	$('.mulaiTime').each(function(i, elm) {
		for(let i = 0; i < 24; i++) {
			let hour = pz(i);
			let opt1 = document.createElement("option");
			opt1.value = `${hour}:00`;
			opt1.innerText = `${hour}:00`;
			this.appendChild(opt1);
			let opt2 = document.createElement("option");
			opt2.value = `${hour}:30`;
			opt2.innerText = `${hour}:30`;
			this.appendChild(opt2);
		}
	});
	
	$('.durHour').each(function(i, elm) {
		for (let i = 0; i < 24; i++) {
			let opt = document.createElement("option");
			opt.value = i;
			opt.innerText = i;
			this.appendChild(opt);
		}
	});
	
	$('.durMinute').each(function(i, elm) {
		for (let i = 0; i < 60; i+=15) {
			let opt = document.createElement("option");
			opt.value = i;
			opt.innerText = pz(i);
			this.appendChild(opt);
		}
	});
	
})();

function pz(str){
	return ("0"+str).slice(-2);
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

		let diff = (endDate.getTime() - beginDate.getTime())/60/1000;
		if (diff < 30) {
			alert('Durasi harus lebih dari 30 menit!');
			return false;
		}
	}

	return true;
}

function updateWaktu(thisElm) {
	let $this = $(thisElm);
	let $durHour = $this.closest('.domainTimesForm').find('.durHour');
	let $durMin = $this.closest('.domainTimesForm').find('.durMinute');
	let $startDate = $this.closest('.domainTimesForm').find('.mulaiDate');
	let $startTime = $this.closest('.domainTimesForm').find('.mulaiTime');
	let $begin = $this.closest('.domainTimesForm').find('.waktuMulai');
	let $end = $this.closest('.domainTimesForm').find('.waktuSelesai');

	let beginDate = new Date(`${$startDate.val()} ${$startTime.val()}`);
	endDate = new Date(beginDate);

	endDate.setHours(
		endDate.getHours()+parseInt($durHour.val()), 
		endDate.getMinutes()+parseInt($durMin.val()), 0
	);

	$begin.val(beginDate.toISOString());
	$end.val(endDate.toISOString());
}

function submitForm() {
	if (validateOtherFields() && validateWaktu()) {
		document.getElementById('msform').submit();
	}
}


