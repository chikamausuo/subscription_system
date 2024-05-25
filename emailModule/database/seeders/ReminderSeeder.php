<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReminderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reminders')->insert([
            'content' => 'Sample reminder content 1',
            'scheduled_at' => now()->addDay(),
        ]);
    
        DB::table('reminders')->insert([
            'content' => 'Sample reminder content 2',
            'scheduled_at' => now()->addDays(2),
        ]);
    
        // Add more sample data as needed
    }
}



