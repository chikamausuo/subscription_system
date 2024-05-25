<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EveryMinute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'every:minute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to run every minute';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
         // Fetch data from the reminders table
         $reminders = DB::table('reminders')->get(['content', 'scheduled_at']);

         // Log the fetched data
         foreach ($reminders as $reminder) {
             Log::info('Content: ' . $reminder->content . ' Scheduled At: ' . $reminder->scheduled_at);
         }
 
         $this->info('The EveryMinute command was executed.');
    }
}
