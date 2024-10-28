<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        // Menjadwalkan pengiriman notifikasi
        $schedule->command('reminders:send')->daily(); // Anda perlu membuat perintah ini
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        // Register console commands here
    }
}
