<?php

namespace ErrorStream\ErrorStream;

use Log;
use Illuminate\Support\ServiceProvider;
use ErrorStream\ErrorStreamClient\ErrorStreamClient;
use ErrorStream\ErrorStreamMonologHandler\ErrorStreamMonologHandler;

class ErrorStreamServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        if(config('services.errorstream.enabled')){
            $monolog = Log::getMonolog();
            $monolog->pushHandler(app('errorstreammonolog'));
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('errorstream', function ($app) {
            $client = new ErrorStreamClient();
            $client->api_token = config('services.errorstream.api_token');
            $client->project_token = config('services.errorstream.project_token');
            return $client;
        });

        $this->app->singleton('errorstreammonolog', function ($app) {
            $client = new ErrorStreamMonologHandler();
            $client->api_token = config('services.errorstream.api_token');
            $client->project_token = config('services.errorstream.project_token');
            return $client;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['errorstream'];
    }
}