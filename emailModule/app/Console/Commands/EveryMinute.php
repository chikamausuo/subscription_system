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
    public function handle(){
    
        // Get the current date and time, rounded to the nearest minute
        $currentDateTime = Carbon::now()->format('Y-m-d H:i:00');

        // Log the current date and time for debugging
        Log::info('Current DateTime: ' . $currentDateTime);

        // Fetch data from the reminders table where scheduled_at matches the current date and time exactly
        $reminders = DB::table('reminders')
            ->where('scheduled_at', $currentDateTime)
            ->get(['content', 'scheduled_at']);

        // Log the fetched data if there are any reminders
        if ($reminders->isNotEmpty()) {
            foreach ($reminders as $reminder) {
                Log::info('Fetched Reminder - Content: ' . $reminder->content . ' Scheduled At: ' . $reminder->scheduled_at);
            }
        } else {
            Log::info('No reminders found for the current date and time.');
        }

        $this->info('The EveryMinute command was executed.');

        return 0;
    }
    }
    

