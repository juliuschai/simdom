<?php

namespace App\Helpers;

use App\Models\Domain;
use App\Models\Permintaan;
use App\User;
use Illuminate\Support\Facades\Mail;

class EmailHelper
{
    static function getEmailUser(Permintaan $permintaan)
    {
        if ($permintaan->domain) {
            // Kalau permintaan untuk edit domain, email pic dari domain
            $email = $permintaan->domain->user->email;
        } else {
            // Kalau permintaan untuk buat domain (belum ada domain), email pic dari permintaan
            $email = $permintaan->user->email;
        }

        return $email;
    }

    static function getNamaDomain(Permintaan $permintaan)
    {
        if ($permintaan->domain) {
            // Kalau permintaan untuk edit domain, nama domain dari domain
            $email = $permintaan->domain->nama_domain;
        } else {
            // Kalau permintaan untuk buat domain (belum ada domain), nama domain dari permintaan
            $email = $permintaan->nama;
        }

        return $email;
    }

    static function getEmailListAdminLayanan()
    {
        $emails = User::where('notif_layanan', true)
            ->pluck('email')
            ->toArray();
        return $emails;
    }

    static function getEmailListAdminJaringan()
    {
        $emails = User::where('notif_jaringan', true)
            ->pluck('email')
            ->toArray();
        return $emails;
    }

    // kirim email pemberitahuan permintaan baru untuk admin
    static function permintaanBaruAdmin(Permintaan $permintaan)
    {
        // Ambil semua admin yang subscribe ke email
        $emails = EmailHelper::getEmailListAdminLayanan(); // TODO:
        $data = [
            'link' => route('permintaan.lihat', [
                'permintaan' => $permintaan->id,
            ]),
            'domain' => EmailHelper::getNamaDomain($permintaan),
            'user' => "{$permintaan->user->nama} - {$permintaan->user->group} - {$permintaan->unit->nama}",
            'keterangan' => $permintaan->keterangan,
        ];

        // Send email
        try {
            Mail::send('email.permintaan_baru', $data, function ($message) use ($emails) {
                $message->to($emails);
                $message->subject('Simdom - Permintaan Baru');
            });
        } catch (\Throwable $th) {
            \Log::warning('Gagal mengemail admin terdapat permintaan baru');
            \Log::warning($th);
        }
    }

    // kirim email pemberitahuan permintaan baru untuk user
    static function permintaanBaruUser(Permintaan $permintaan)
    {
        $email = EmailHelper::getEmailUser($permintaan);

        if ($permintaan->user->role == 'admin') {
            $user = 'Admin';
        } else {
            $user = 'Anda';
        }

        $data = [
            'link' => route('permintaan.lihat', [
                'permintaan' => $permintaan->id,
            ]),
            'user' => $user,
            'domain' => EmailHelper::getNamaDomain($permintaan),
            'keterangan' => $permintaan->keterangan,
        ];

        // Send email
        try {
            Mail::send('email.permintaan_baru', $data, function ($message) use ($email) {
                $message->to($email);
                $message->subject('Simdom - Permintaan Baru');
            });
        } catch (\Throwable $th) {
            \Log::warning('Gagal mengemail user terdapat permintaan baru');
            \Log::warning($th);
        }
    }

    // Send email ke user bahwa permintaan terdapat perubahan status ('diterima', 'selesai', 'ditolak')
    static function notifyStatus(Permintaan $permintaan, string $status) {
        if ($status == 'Permintaan sedang diproses') {
            $emails = EmailHelper::getEmailListAdminJaringan();
        } else if ($status == 'Permintaan sedang diperiksa') {
            $emails = EmailHelper::getEmailListAdminLayanan();
        } else {
            $emails = [];
        }
        $emails[] = EmailHelper::getEmailUser($permintaan);

        $data = [
            'status' => $status,
            'link' => route('permintaan.lihat', [
                'permintaan' => $permintaan->id,
            ]),
            'domain' => EmailHelper::getNamaDomain($permintaan),
            'keterangan' => $permintaan->keterangan,
        ];

        try {
            Mail::send('email.permintaan_status', $data, function ($message) use ($emails) {
                $message->to($emails);
                $message->subject('Simdom - Status Permintaan');
            });
        } catch (\Throwable $th) {
            \Log::warning('Gagal mengemail user perubahan status permintaan');
            \Log::warning($th);
        }
    }

    static function notifyTransfer(string $from, string $to, Domain $domain) {
        $data = [
            'from' => $from,
            'to' => $to,
            'domain' => $domain->nama_domain,
        ];

        // Kirim ke pic lama
        try {
            Mail::send('email.permintaan_transfer', $data, function ($message) use ($from) {
                $message->to($from);
                $message->subject('Simdom - Perubahan PIC');
            });
        } catch (\Throwable $th) {
            \Log::warning('Gagal mengemail user perubahan PIC ke email '.$from.' '.$from.' ke PIC '.$to);
            \Log::warning($th);
        }

        // Kirim ke pic baru
        try {
            Mail::send('email.permintaan_transfer', $data, function ($message) use ($to) {
                $message->to($to);
                $message->subject('Simdom - Perubahan PIC');
            });
        } catch (\Throwable $th) {
            \Log::warning('Gagal mengemail user perubahan ke email '.$from.' '.$to.' dari PIC '.$from.' ke PIC '.$to);
            \Log::warning($th);
        }
    }

    static function notifyReminder(Domain $domain) {
        $email = $domain->user->email;
        $data = [
            'nama' => $domain->nama_domain,
            'linkExtend' => route('domain.extend', ['domain' => $domain->id]),
            'linkTransfer' => route('domain.transfer', ['domain' => $domain->id])
        ];

        try {
            Mail::send('email.domain_reminder', $data, function ($message) use ($email) {
                $message->to($email);
                $message->subject('Simdom - Reminder PIC');
            });
        } catch (\Throwable $th) {
            \Log::warning('Gagal mengemail user reminder PIC');
            \Log::warning($th);
        }
    }
}
