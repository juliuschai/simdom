<?php

namespace App\Models;

use App\Helpers\EmailHelper;
use App\Helpers\FileHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Permintaan extends Model
{
    protected $guarded = [];

    /**
     * domain_id
     * nama_pj
     * nama_ins
     * no_telp
     * email
     * tgl_pengajuan
     * nama_domain
     * jenis_domain
     * status (menunggu,diterima,ditolak)
     */

    static function selectList()
    {
        return Permintaan::join('users', 'users.id', '=', 'permintaans.user_id')
            ->join('units', 'units.id', '=', 'permintaans.unit_id')
            ->select([
                'permintaans.id',
                'users.nama as user_nama',
                'units.nama as unit_nama',
                'permintaans.nama_domain',
                'permintaans.server',
                'permintaans.kapasitas',
                'permintaans.ip',
                'permintaans.status',
                'permintaans.keterangan',
                'permintaans.created_at',
            ]);
    }

    static function selectListUser()
    {
        return Permintaan::selectList()
            ->leftJoin('domains', 'domains.id', '=', 'permintaans.domain_id')
            ->where(function($q) {
                return $q->where('permintaans.user_id', auth()->id())
                    ->orWhere('domains.user_id', auth()->id());
            });
    }

    static function permintaanBaru($req, $domain_id = null)
    {
        // Proses file
        if ($req->has('surat')) {
            $file = $req->file('surat');
            $original = $file->getClientOriginalName();
            $original = substr(
                $original,
                strlen($original) - 230,
                strlen($original)
            );
            $filename = date("hms") . '_' . $original;
            $file_path = $file->storeAs('surat', $filename, 'local');
        } else {
            $file_path = null;
        }

        $unit_id = Unit::getIdFromUnitOrCreate($req->unit, $req->tipeUnit);

        $permintaan = Permintaan::create([
            'domain_id' => $domain_id,
            'user_id' => auth()->id(),
            'unit_id' => $unit_id,
            'surat' => $file_path,
            'nama_domain' => $req->namaDomain,
            'deskripsi' => $req->deskripsi,
            'server' => $req->serverDomain,
            'kapasitas' => $req->kapasitas,
            'keterangan' => $req->keterangan,
            'ip' => $req->ip,
        ]);

        EmailHelper::permintaanBaruAdmin($permintaan);
        EmailHelper::permintaanBaruUser($permintaan);

        return $permintaan;
    }

    /**
     * Buat permintaan dari sebuah domain dengan keterangan tertentu
     * Permintaan yang dibuat langsung di
     *
     * @param Domain domain domain dari record yang ingin dibuat
     * @param integer user_id user yang membuat permintaan
     * @param string keterangan keterangan yang diinginkan
     * @param bool selesai anggap permintaan sudah selesai
     */
    static function permintaanDariDomain(
        Domain $domain,
        string $keterangan,
        bool $langsung
    ) {
        $permintaan = new Permintaan();
        $permintaan->fill([
            'domain_id' => $domain->id,
            'user_id' => auth()->id(),
            'unit_id' => $domain->unit_id,
            'surat' => null,
            'nama_domain' => $domain->nama_domain,
            'deskripsi' => $domain->deskripsi,
            'server' => $domain->server,
            'kapasitas' => $domain->kapasitas,
            'keterangan' => $keterangan,
            'ip' => $domain->ip,
        ]);

        // Jika permintaan langsung diaplikasikan ke Domain
        if ($langsung) {
            $permintaan->fill([
                'status' => 'selesai',
                'waktu_konfirmasi' => now(),
                'waktu_selesai' => now(),
            ]);
        }

        $permintaan->save();

        EmailHelper::permintaanBaruAdmin($permintaan);
        EmailHelper::permintaanBaruUser($permintaan);

        return $permintaan;
    }

    static function export($req) {
        $query = DB::table('permintaans as p')
            ->join('domains as d', 'd.id', '=', 'p.user_id')
            ->join('users as u', 'u.id', '=', 'p.user_id')
            ->join('units', 'units.id', '=', 'p.unit_id')
            ->orderBy('p.created_at');

        if (!$req->has('semuaWaktu')) {
            $query = $query->where('p.created_at', '>', Carbon::parse($req->waktuMulai))
                ->where('p.created_at', '<', Carbon::parse($req->waktuAkhir));
        }

        $datas = $query->get([
            'u.nama as u_nama',
            'u.email as u_email',
            'u.integra as u_integra',
            'u.group as u_group',
            'u.no_wa as u_no_wa',
            'units.nama as unit_nama',
            'd.nama_domain as domain_aktif',
            'p.nama_domain as nama_domain',
            'p.deskripsi as deskripsi',
            'p.ip as ip',
            'p.server as server',
            'p.kapasitas as kapasitas',
            'p.status as status',
            'p.keterangan as keterangan',
            DB::raw('DATE_ADD(p.waktu_konfirmasi, INTERVAL 7 HOUR) as waktu_konfirmasi'),
            DB::raw('DATE_ADD(p.waktu_selesai, INTERVAL 7 HOUR) as waktu_selesai'),
            DB::raw('DATE_ADD(p.created_at, INTERVAL 7 HOUR) as waktu_dibuat'),
        ]);

        foreach ($datas as $data) {
            // Calculate lama_proses
            $dateSelesai = Carbon::parse($data->waktu_selesai);
            $dateKonfirmasi = Carbon::parse($data->waktu_konfirmasi);
            $data->lama_proses = $dateSelesai->diffInDays($dateKonfirmasi);
        }

        $htmlString = view('permintaan.export_table', compact('datas'));
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Html();
        $spreadsheet = $reader->loadFromString($htmlString);

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
        $currentTime = Carbon::now('Asia/Jakarta')->format("Y-m-d_Hi");
        if (!file_exists(storage_path("app/export"))) {
            mkdir(storage_path("app/export"), 0777, true);
        }
        $filename = "permintaan_export_$currentTime.xls";
        $writer->save(storage_path("app/export/$filename"));
        // FileHelper::scheduleDelete("export/$filename");
        return FileHelper::downloadSuratOrFail("export/$filename", $filename);
        // FileHelper::deleteDokumenOrFail($filename);
    }

    function user()
    {
        return $this->belongsTo('App\User');
    }

    function unit()
    {
        return $this->belongsTo('App\Models\Unit');
    }

    function domain()
    {
        return $this->belongsTo('App\Models\Domain');
    }
}
