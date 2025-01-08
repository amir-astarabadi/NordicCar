<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SystemDeploy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:deploy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'run necessary commands on deployment';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Artisan::call("migrate", ['--force' => true]);
    }
}
