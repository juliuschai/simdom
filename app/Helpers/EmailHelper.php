<?php

namespace App\Helpers;

use App\User;

class EmailHelper
{
    static function test()
    {
        EmailHelper::getEmailList();
    }

    static function getEmailList()
    {
        $emails = User::where('email_notification', true)
            ->pluck('email')
            ->toArray();
        return $emails;
    }

    /**
     * @param string subject subject email
     * @param string id permintaan id for link
     */
    static function notifyAdmin(string $subject, string $id)
    {
        $emails = EmailHelper::getEmailList();
        $data = [
            'id' => $id,
        ];
        Mail::send('Html.view', $data, function ($message) use (
            $subject,
            $emails
        ) {
            $message->to($emails);
            $message->subject($subject);
        });
    }

    static function notifPermintaanBaru(SejarahDomain $permintaan)
    {
        $emails = EmailHelper::getEmailList();
        $data = [
            'link' => route('permintaan.lihat', [
                'permintaan' => $permintaan->id,
            ]),
            'user' => "{$permintaan->user->nama} - {$permintaan->user->group} - {$permintaan->unit->nama}",
            'domain' => $permintaan->domain,
            'keterangan' => $permintaan->keterangan,
        ];
        $datas[] = "<a href=\"{$data['link']}\">";
        EmailHelper::emailList('Simdom - Permintaan Baru', $emails, $datas);
    }

    static function emailList($subject, $emails, $datas)
    {
        Mail::send('email.list', $datas, function ($message) use ($subject, $emails) {
            $message->to($emails);
            $message->subject($subject);
        });

    }
}
