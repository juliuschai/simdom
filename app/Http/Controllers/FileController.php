<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Models\Permintaan;
use Illuminate\Http\Request;

class FileController extends Controller
{
    function getSurat(Permintaan $permintaan) {
        $filename = $permintaan->surat;
        return FileHelper::getSuratOrFail($filename);
    }

    function downloadSurat(Permintaan $permintaan) {
        $filename = $permintaan->surat;
        return FileHelper::downloadSuratOrFail($filename);
    }
}
