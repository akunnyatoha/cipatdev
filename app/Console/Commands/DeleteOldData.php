<?php

namespace App\Console\Commands;
use App\Models\Peminjaman;
use Illuminate\Console\Command;

class DeleteOldData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-old-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $fiveYearsAgo = now()->subYears(5);

        Peminjaman::where('created_at', '<', $fiveYearsAgo)->delete();
    }

}
