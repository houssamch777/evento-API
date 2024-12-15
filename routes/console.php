<?php

use App\Console\Commands\CleanupBoostedEvents;

use App\Console\Commands\UpdateEventStatus;
use Illuminate\Support\Facades\Schedule;

/*
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();
*/
Schedule::command(CleanupBoostedEvents::class)->daily();
// Run the event status update command every minute
Schedule::command(UpdateEventStatus::class)
->everyMinute()
->onFailure(function () {
    Log::error('Schedule failed: app:update-event-status');
});

//Schedule::command('test:cron')->everySecond();