<?php

namespace Aidias\GelbCore\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InstallAuthCommand extends Command
{
    /**
     * Hidden Command
     * 
     * @var bool
     */
    protected $hidden = false;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gelb:install:auth';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Laravel Auth package with GelbCore changes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('We are installing Authentication details...');
        
        $this->call('ui', [
            'type' => 'vue'
        ]);

        $this->call('ui:auth', [
            '--force' => true,
        ]);

        $this->comment('Authentication and UI has been installed');
    }
}