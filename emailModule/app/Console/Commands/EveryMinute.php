<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

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
    protected $description = 'Command that runs every minute';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Get the current date
        $currentDate = Carbon::today()->toDateString();

        // Log the current date for debugging
        Log::info('Current Date: ' . $currentDate);

        // Fetch data from the reminders table where scheduled_at date matches the current date
        $reminders = DB::table('reminders')
            ->whereDate('scheduled_at', $currentDate)
            ->get(['content', 'scheduled_at']);

        // Log the query being executed for debugging
        $query = DB::table('reminders')
            ->whereDate('scheduled_at', $currentDate)
            ->toSql();
        Log::info('Executed Query: ' . $query);

        // Log the fetched data if there are any reminders
        if ($reminders->isNotEmpty()) {
            foreach ($reminders as $reminder) {
                Log::info('Fetched Reminder - Content: ' . $reminder->content . ' Scheduled At: ' . $reminder->scheduled_at);
            }
        } else {
            Log::info('No reminders found for the current date.');
        }

        $this->info('The EveryMinute command was executed.');

        return 0;
    }
}
