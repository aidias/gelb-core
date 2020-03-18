<?php

namespace Aidias\GelbCore\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
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
        $this->removeNodeModules();
        $this->updatePackage();
        $this->copyStubs();
    }

    /**
     * Install or Not Auth Package
     * 
     * @return void
     */
    public function installAuth()
    {
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

    /**
     * Update Package.json File
     * 
     * @return void
     */
    public function updatePackage()
    {
        $this->info('Updating package.json with new packages');

        if(! file_exists(base_path('package.json'))) {
            return;
        }

        $packages = json_decode(file_get_contents(base_path('package.json')), true);

        $packages['devDependencies'] = [
            'tailwindcss' => '^1.2.0',
        ] + Arr::except($packages['devDependencies'], [
            'bootstrap',
            'jquery',
            'popper.js'
        ]);

        ksort($packages['devDependencies']);

        file_put_contents(
            base_path('package.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );

        $this->info('Package.json update has been finished.');
    }

    /**
     * Remove the installed Node modules.
     *
     * @return void
     */
    public function removeNodeModules()
    {
        tap(new Filesystem, function ($files) {
            $files->deleteDirectory(base_path('node_modules'));

            $files->delete(base_path('yarn.lock'));
        });
    }

    public function copyStubs()
    {
        copy(__DIR__.'/../stubs/webpack.mix.js', base_path('webpack.mix.js'));
        copy(__DIR__.'/../stubs/tailwind.config.js', base_path('tailwind.config.js'));
        copy(__DIR__.'/../stubs/resources/sass/app.scss', resource_path('sass/app.scss'));
        copy(__DIR__.'/../stubs/resources/js/bootstrap.js', resource_path('js/bootstrap.js'));
    }
}