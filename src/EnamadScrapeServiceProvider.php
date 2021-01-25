<?php

namespace AmiraliBagheri\EnamadScrape;

use Illuminate\Support\ServiceProvider;

class EnamadScrapeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('enamad', function() {
            return new Enamad();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
