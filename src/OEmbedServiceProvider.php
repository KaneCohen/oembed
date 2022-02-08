<?php
namespace Cohensive\OEmbed;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class OEmbedServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Boots the service provider.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/config.php' => $this->app->configPath('oembed.php'),
            ], 'config');
        }
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->registerConfig();

        $this->app->singleton('oembed', function ($app) {
            return new OEmbed($app['config']['oembed']);
        });

        $this->app->alias('oembed', OEmbed::class);
    }

    public function provides(): array
    {
        return [OEmbed::class, 'oembed'];
    }

    private function registerConfig(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../resources/config.php', 'oembed');
    }
}
