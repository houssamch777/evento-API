<?php

namespace App\Console\Commands;

use App\Models\Event;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateEventStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-event-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update event status to Completed if the end date has passed.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //

        try {
            $now = Carbon::now();
    
            // Scheduled → Expired
            $expiredEvents = Event::where('status', 'Scheduled')
                ->where('start_date', '<', $now)
                ->update(['status' => 'Expired']);
            log::info("Updated {$expiredEvents} event(s) from Scheduled to Expired.");
            $this->info("Updated {$expiredEvents} event(s) from Scheduled to Expired.");
            // Ready → Ongoing
            $ongoingEvents = Event::where('status', 'Ready')
                ->where('start_date', '<=', $now)
                ->where('end_date', '>', $now)
                ->update(['status' => 'Ongoing']);
            Log::info("Updated {$ongoingEvents} event(s) from Ready to Ongoing.");
            $this->info("Updated {$ongoingEvents} event(s) from Ready to Ongoing.");
    
            // Ongoing → Completed
            $completedEvents = Event::where('status', 'Ongoing')
                ->where('end_date', '<=', $now)
                ->update(['status' => 'Completed']);
            Log::info("Updated {$completedEvents} event(s) from Ongoing to Completed.");
            $this->info("Updated {$completedEvents} event(s) from Ongoing to Completed.");
    
            $this->info("Status updates completed successfully.");
        } catch (\Exception $e) {
            Log::error("Error updating event statuses: " . $e->getMessage());
            $this->error("Failed to update event statuses. Check the logs for details.");
        }
    
    }
}
