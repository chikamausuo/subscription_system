<?php



// app/Console/Commands/EveryMinute.php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class EveryMinute extends Command
{
    protected $signature = 'every:minute';
    protected $description = 'Command that runs every minute';

    public function handle()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        Log::info('Current Date: ' . $currentDate);

        $reminders = DB::table('reminders')
            ->whereDate('scheduled_at', $currentDate)
            ->get(['content', 'scheduled_at']);

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
