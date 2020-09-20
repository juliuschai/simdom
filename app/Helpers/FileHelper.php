<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class FileHelper {
	static function getSuratOrFail($filename) {
		if (Storage::disk('local')->exists($filename)){
			return Storage::disk('local')->response($filename);
		} else {
			abort(404, 'File tidak ditemukan di server');
		}
	}

	static function downloadSuratOrFail($filename) {
		if (Storage::disk('local')->exists($filename)){
			return Storage::disk('local')->download($filename);
		} else {
			abort(404, 'File tidak ditemukan di server');
		}
	}
}
