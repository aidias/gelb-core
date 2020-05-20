<?php

namespace Aidias\GelbCore\Console;

use Aidias\GelbCore\Helper;
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

        if($this->confirm('Can we install auth packages?'))
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
        $this->info('We are updating package.json with new packages...');

        if(! file_exists(base_path('package.json'))) {
            return;
        }

        $packages = json_decode(file_get_contents(base_path('package.json')), true);

        $packages['devDependencies'] = [
            'material-design-icons' => '^3.0.1',
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

        $this->comment('Package.json update has been finished.');
    }

    /**
     * Remove the installed Node modules.
     *
     * @return void
     */
    public function removeNodeModules()
    {
        $this->info('We are removing node_modules...');

        tap(new Filesystem, function ($files) {
            $files->deleteDirectory(base_path('node_modules'));

            $files->delete(base_path('yarn.lock'));
        });
    }

    /**
     * Copy all GelbCore files to Laravel core application
     * 
     * @return void
     */
    public function copyStubs()
    {
        $this->info('We are adding GelbCore files...');

        // Deleting some laravel files 
        tap(new Filesystem, function ($files) {
            $files->delete(app_path('Http/Controllers/HomeController.php'));
            $files->delete(resource_path('views/home.blade.php'));
            $files->delete(resource_path('views/welcome.blade.php'));
            $files->delete(resource_path('views/layouts/app.blade.php'));
            $files->deleteDirectory(resource_path('views/layouts'));
        });

        // Copying general files
        copy(__DIR__.'/../stubs/webpack.mix.js', base_path('webpack.mix.js'));
        copy(__DIR__.'/../stubs/tailwind.config.js', base_path('tailwind.config.js'));

        // Copying assets files
        copy(__DIR__.'/../stubs/resources/sass/app.scss', resource_path('sass/app.scss'));
        copy(__DIR__.'/../stubs/resources/js/bootstrap.js', resource_path('js/bootstrap.js'));

        // Copying Controllers files
        Helper::xcopy(__DIR__.'/../stubs/Http/Controllers/Exclusive', app_path('Http/Controllers/Exclusive'));
        Helper::xcopy(__DIR__.'/../stubs/Http/Controllers/General', app_path('Http/Controllers/General'));

        // Copying views
        Helper::xcopy(__DIR__.'/../stubs/resources/views/auth/layouts', resource_path('views/auth/layouts'));
        Helper::xcopy(__DIR__.'/../stubs/resources/views/auth/passwords', resource_path('views/auth/passwords'));
        copy(__DIR__.'/../stubs/resources/views/auth/login.blade.php', resource_path('views/auth/login.blade.php'));
        copy(__DIR__.'/../stubs/resources/views/auth/register.blade.php', resource_path('views/auth/register.blade.php'));
        copy(__DIR__.'/../stubs/resources/views/auth/verify.blade.php', resource_path('views/auth/verify.blade.php'));
        Helper::xcopy(__DIR__.'/../stubs/resources/views/exclusive', resource_path('views/exclusive'));
        Helper::xcopy(__DIR__.'/../stubs/resources/views/general', resource_path('views/general'));

        // Copying routes files
        copy(__DIR__.'/../stubs/routes/web.php', base_path('routes/web.php'));

        $this->comment('We finished to add the files.');
    }
}