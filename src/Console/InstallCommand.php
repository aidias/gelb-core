<?php

namespace Aidias\GelbCore\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InstallCommand extends Command
{
    /**
     * Hidden Command
     * 
     * @var bool
     */
    protected $hidden = true;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gelb:install
                            {--noauth : Do not install auth packages}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install GelbCore features into Laravel';

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
        $this->info('Installing Aidias/GelbCore...');

        $this->installAuth();
    }

    /**
     * Install or Not Auth Package
     * 
     * @return void
     */
    public function installAuth() {
        if($this->option('noauth'))
        {
            if ($this->confirm('Are you sure you do not wish to install auth packages?'))
            {
                return ;
            }
        }

        if($this->confirm('Install auth packages?'))
        {
            $this->call('gelb:install:auth');
        }
    }
}