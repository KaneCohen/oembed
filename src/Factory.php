<?php
namespace Cohensive\OEmbed;

class Factory
{
    /**
     * Configs.
     */
    protected array $config;

    /**
     * Create Embed factory and set providers from config.
     */
    public function __construct(?array $config = null)
    {
        if (is_null($config)) {
            $this->config = require('./resources/config.php');
        }
    }

    /**
     * Create a new OEmbed instance.
     */
    public function make(): OEmbed
    {
        return new OEmbed($this->config);
    }

    /**
     * Helper method to quickly get embed data from OEmbed instance.
     */
    public function get(string $url, array $options = []): ?Embed
    {
        return $this->make()->withOptions($options)->get($url);
    }
}
