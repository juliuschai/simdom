<?php

namespace App\Console\Commands;

use App\Helpers\EmailHelper;
use App\Models\Domain;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PICReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:remind';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ingatkan user apakah PIC dari domain masih berlaku/aktif';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $domains = Domain::where('aktif', 'aktif')
            ->where('reminder', DB::raw('CURDATE()'))
            ->get();

        foreach ($domains as $domain) {
            EmailHelper::notifyReminder($domain);
        }
        // Set the next domain for the next six months
        DB::statement('UPDATE domains
            SET aktif = "terlantar"
            WHERE reminder = CURDATE();');

        return 0;
    }
}
