<?php

namespace ArcherZdip\Setting;

use ArcherZdip\Setting\Console\SettingGetCommand;
use ArcherZdip\Setting\Console\SettingSetCommand;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations'),
            ], 'migrations');
            $this->commands([
                SettingSetCommand::class,
                SettingGetCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('setting', \ArcherZdip\Setting\Setting::class);
    }
}
