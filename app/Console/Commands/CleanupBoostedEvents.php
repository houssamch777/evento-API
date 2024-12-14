<?php

namespace App\Console\Commands;

use App\Models\BoostedEvent;
use Illuminate\Console\Command;

class CleanupBoostedEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cleanup-boosted-events';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove or update boosted events whose boost period has ended';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        // حذف الفعاليات التي انتهت مدة تعزيزها
        $expiredBoosts = BoostedEvent::where('boost_end', '<', now())->get();

        foreach ($expiredBoosts as $boostedEvent) {
            // إذا أردت تحديث حالتها بدلاً من الحذف:
            // $boostedEvent->update(['status' => 'expired']);

            // حذف السجل:
            $boostedEvent->delete();
        }

        $this->info('Expired boosted events have been cleaned up.');
        return 0;
    }
}
