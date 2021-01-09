<?php namespace Cohensive\OEmbed;

use Illuminate\Support\ServiceProvider;

class OEmbedServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     */
    protected bool $defer = true;

    /**
     * Boots the service provider.
     */
    public function boot(): void
    {
        $source = __DIR__ . '/../resources/config.php';

        if (function_exists('config_path')) {
            $this->publishes([
                $source => config_path('oembed.php'),
            ], 'config');
        }

        $this->mergeConfigFrom(
            $source, 'oembed'
        );
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app->singleton('oembed', function($app) {
            return new OEmbed($app['config']['oembed']);
        });

        $this->app->alias('oembed', OEmbed::class);
    }

    public function provides(): array
    {
        return ['oembed'];
    }
}
