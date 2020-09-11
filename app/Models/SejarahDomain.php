<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SejarahDomain extends Model
{
    protected $guarded = [];

    /**
     * domain_aktif_id
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
        return SejarahDomain::join('users', 'users.id', '=', 'sejarah_domains.user_id')
            ->join('tipe_servers', 'tipe_servers.id', '=', 'sejarah_domains.tipe_server_id')
            ->join('units', 'units.id', '=', 'sejarah_domains.unit_id')
            ->select([
                'sejarah_domains.id',
                'users.nama as user_nama',
                'units.nama as unit_nama',
                'sejarah_domains.nama_domain',
                'tipe_servers.nama_server',
                'sejarah_domains.kapasitas',
                'sejarah_domains.ip_domain',
                'sejarah_domains.status',
                'sejarah_domains.keterangan',
            ])
            ->orderBy('sejarah_domains.created_at', 'DESC');
    }

    static function permintaanBaru($req, $domain_id)
    {
        if ($req->has('surat')) {
            $file = $req->file('surat');
            $filename = substr(
                date("hms") . '_' . $file->getClientOriginalName(),
                250
            );
            $file_path = $file->storeAs('surat', $filename, 'local');
        } else {
            $file_path = null;
        }

        $permintaan = SejarahDomain::create([
            'domain_aktif_id' => $domain_id,
            'user_id' => auth()->id(),
            'unit_id' => $req->unit,
            'surat' => $file_path,
            'nama_domain' => $req->namaDomain,
            'nama_panjang' => $req->namaPanjang,
            'tipe_server_id' => $req->tipeServer,
            'kapasitas' => $req->kapasitas,
            'keterangan' => $req->keterangan,
            'ip_domain' => $req->ipAddress,
        ]);

        return $permintaan;
    }

    /**
     * Buat permintaan dari sebuah domain aktif dengan keterangan tertentu
     * Permintaan yang dibuat langsung di
     *
     * @param DomainAktif domain domain_aktif dari record yang ingin dibuat
     * @param integer user_id user yang membuat permintaan
     * @param string keterangan keterangan yang diinginkan
     * @param bool selesai anggap permintaan sudah selesai dilakukan dan langsung merubah domain aktif
     */
    static function permintaanDariDomain(
        DomainAktif $domain,
        string $keterangan,
        bool $langsung
    ) {
        $permintaan = new SejarahDomain();
        $permintaan->fill([
            'domain_aktif_id' => $domain->id,
            'user_id' => auth()->id(),
            'unit_id' => $domain->unit_id,
            'surat' => null,
            'nama_domain' => $domain->nama_domain,
            'nama_panjang' => $domain->nama_panjang,
            'tipe_server_id' => $domain->tipe_server_id,
            'kapasitas' => $domain->kapasitas,
            'keterangan' => $keterangan,
            'ip_domain' => $domain->ip_domain,
        ]);

        // Jika permintaan langsung diaplikasikan ke DomainAktif
        if ($langsung) {
            $permintaan->fill([
                'status' => 'selesai',
                'waktu_konfirmasi' => now(),
                'waktu_selesai' => now(),
            ]);
        }

        $permintaan->save();

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

    function tipeServer()
    {
        return $this->belongsTo('App\Models\TipeServer');
    }

    function domainAktif()
    {
        return $this->belongsTo('App\Models\DomainAktif');
    }
}
