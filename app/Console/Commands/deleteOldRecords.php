<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\FilesModel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class deleteOldRecords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hourly:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete old records';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::table('files')->where('datecreated', '<=', Carbon::now()->subDays(1))->delete();
        return Command::SUCCESS;
    }
}
