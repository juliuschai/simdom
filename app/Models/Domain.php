<?php

namespace App\Models;

use App\Helpers\FileHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Domain extends Model
{
    protected $guarded = [];

    /**
     * nama_pj
     * nama_ins
     * no_telp
     * email
     * nama_domain
     * jenis_domain
     * status
     */

    static function selectList()
    {
        return Domain::join('users', 'users.id', '=', 'domains.user_id')
            ->join('units', 'units.id', '=', 'domains.unit_id')
            ->select([
                'domains.id',
                'users.nama as user_nama',
                'units.nama as unit_nama',
                'domains.alias',
                'domains.server',
                'domains.kapasitas',
                'domains.ip',
                'domains.status',
                'domains.aktif',
                'domains.created_at',
            ]);
    }

    static function selectListUser()
    {
        return Domain::selectList()->where('user_id', auth()->id());
    }

    static function selectLihatData()
    {
        return Domain::join('users', 'users.id', '=', 'domains.user_id')
            ->join('units', 'units.id', '=', 'domains.unit_id')
            ->select([
                'domains.id',
                'units.id as unit_id',
                'domains.server',
                'domains.aktif',
                'domains.alias',
                'domains.kapasitas',
                'domains.ip',
            ]);
    }

    // Buat domain dari sebuah permintaan
    static function simpanDariPermintaan(Permintaan $per)
    {
        if (!$per->domain_id) {
            // Jika membuat domain baru
            $domain = new Domain();
            $domain->alias = $per->nama_domain;
            $domain->user_id = $per->user_id;
            $domain->reminder = date('Y-m-d', strtotime("+6 months", strtotime(date("Y-m-d"))));
        } else {
            // Jika memperbaharui sebuah domain
            $domain = Domain::find($per->domain_id);
            $domain->alias = $domain->aliases();
        }

        $domain->fill([
            'unit_id' => $per->unit_id,
            'ip' => $per->ip,
            'nama_domain' => $per->nama_domain,
            'deskripsi' => $per->deskripsi,
            'server' => $per->server,
            'kapasitas' => $per->kapasitas,
            'status' => 'siap',
        ]);

        $domain->save();

        return $domain;
    }

    static function export($req) {
        $query = DB::table('domains as d')
            ->join('users as u', 'u.id', '=', 'd.user_id')
            ->join('units', 'units.id', '=', 'd.unit_id')
            ->orderBy('d.created_at');

        $datas = $query->get([
            'u.nama as u_nama',
            'u.email as u_email',
            'u.integra as u_integra',
            'u.group as u_group',
            'u.no_wa as u_no_wa',
            'units.nama as unit_nama',
            'd.nama_domain as nama_domain',
            'd.alias as alias',
            'd.deskripsi as deskripsi',
            'd.ip as ip',
            'd.server as server',
            'd.kapasitas as kapasitas',
            'd.status as status',
            'd.aktif as aktif',
            DB::raw('DATE_ADD(d.created_at, INTERVAL 7 HOUR) as waktu_dibuat'),
        ]);

        $htmlString = view('domain.export_table', compact('datas'));
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Html();
        $spreadsheet = $reader->loadFromString($htmlString);
        
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
        $currentTime = Carbon::now('Asia/Jakarta')->format("Y-m-d_Hi");
        if (!file_exists(storage_path("app/export"))) {
            mkdir(storage_path("app/export"), 0777, true);
        }
        $filename = "domain_aktif_export_$currentTime.xls";
        $writer->save(storage_path("app/export/$filename"));
        // FileHelper::scheduleDelete("export/$filename");
        return FileHelper::downloadSuratOrFail("export/$filename", $filename);
        // FileHelper::deleteDokumenOrFail($filename);
    }

    function aliases()
    {
        $arr = $this->permintaans
            ->unique('nama_domain')
            ->map(function ($array) {
                return $array['nama_domain'];
            })
            ->all();
        return implode(',', $arr);
    }

    function user()
    {
        return $this->belongsTo('App\User');
    }

    function unit()
    {
        return $this->belongsTo('App\Models\Unit');
    }

    function permintaans()
    {
        return $this->hasMany('App\Models\Permintaan', 'domain_id', 'id');
    }
}
