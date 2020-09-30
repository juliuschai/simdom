<?php

namespace App\Models;

use App\Helpers\FileHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Redirect extends Model
{
    protected $guarded = [];

    static function selectList()
    {
        return Redirect::select([
                'id',
                'link_lama',
                'link_baru',
                'keterangan',
                'created_at'
            ]);
    }

    function isiDariRequest($req)
    {
        $this->fill([
            'link_lama' => $req->linkLama,
            'link_baru' => $req->linkBaru,
            'keterangan' => $req->keterangan,
        ]);
    }

    static function redirectBaru($req)
    {
        $redirect = new Redirect();
        $redirect->isiDariRequest($req);
        $redirect->save();

        return $redirect;
    }

    static function export($req) {
        $query = DB::table('redirects as r')
            ->orderBy('r.created_at');

        $datas = $query->get([
            'r.link_lama',
            'r.link_baru',
            'r.keterangan',
            DB::raw('DATE_ADD(r.created_at, INTERVAL 7 HOUR) as waktu_dibuat'),
        ]);

        $htmlString = view('redirect.export_table', compact('datas'));
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Html();
        $spreadsheet = $reader->loadFromString($htmlString);
        
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
        $currentTime = Carbon::now('Asia/Jakarta')->format("Y-m-d_Hi");
        if (!file_exists(storage_path("app/export"))) {
            mkdir(storage_path("app/export"), 0777, true);
        }
        $filename = "redirect_export_$currentTime.xls";
        $writer->save(storage_path("app/export/$filename"));
        // FileHelper::scheduleDelete("export/$filename");
        return FileHelper::downloadSuratOrFail("export/$filename", $filename);
        // FileHelper::deleteDokumenOrFail($filename);
    }
}
