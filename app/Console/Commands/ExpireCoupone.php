<?php

namespace App\Console\Commands;

use App\Models\Coupone;
use Illuminate\Console\Command;

class ExpireCoupone extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expire-coupone';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Coupone::where('created_at', '<', now()->subHours(3))->first()->delete();
    }
}
