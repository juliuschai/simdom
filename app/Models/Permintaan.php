<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
            ->join('domains', 'domains.id', '=', 'permintaans.domain_id')
            ->where('domains.user_id', auth()->id());
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
     * Buat permintaan dari sebuah domain aktif dengan keterangan tertentu
     * Permintaan yang dibuat langsung di
     *
     * @param Domain domain domain dari record yang ingin dibuat
     * @param integer user_id user yang membuat permintaan
     * @param string keterangan keterangan yang diinginkan
     * @param bool selesai anggap permintaan sudah selesai dilakukan dan langsung merubah domain aktif
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
