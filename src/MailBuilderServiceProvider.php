<?php

namespace Laravel\MailBuilder;

use Illuminate\Support\ServiceProvider;

class MailBuilderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     */
    public function boot()
    {
    }

    /**
     * Register any package services.
     */
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\InstallCommand::class,
                Console\MailBuilderCommand::class
            ]);
        }
    }
}
