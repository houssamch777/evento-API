<?php

namespace App\Console\Commands;

use App\Models\Event;
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


        $now = Carbon::now();

        // Find events with "Scheduled" or "Ongoing" status whose end_date has passed
        $events = Event::whereIn('status', ['Scheduled', 'Ongoing'])
            ->where('end_date', '<', $now)
            ->get();

        foreach ($events as $event) {
            if($event->status=='Scheduled'){
                $event->status = 'Cancelled';
                $event->save();
                $this->info("Updated event ID {$event->id} to 'Cancelled'.");
            }else{
                $event->status = 'Completed';
                $event->save();
                $this->info("Updated event ID {$event->id} to 'Completed'.");
            }
        }

        $this->info("Event status update completed.");
    }
}
