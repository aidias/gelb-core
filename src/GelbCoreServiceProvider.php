<?php

namespace Aidias\GelbCore;

use Aidias\GelbCore\Console\InstallAuthCommand;
use Aidias\GelbCore\Console\InstallCommand;
use Illuminate\Support\ServiceProvider;

class GelbCoreServiceProvider extends ServiceProvider 
{
    /**
     * Register GelbCore services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap GelbCore services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole())
        {        
            $this->commands([
                InstallCommand::class,
                InstallAuthCommand::class
            ]);
        }
    }
}