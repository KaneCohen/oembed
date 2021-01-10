<?php
namespace Cohensive\OEmbed;

class OEmbed
{
    /**
     * AMP mode.
     */
    protected bool $amp = false;

    /**
     * Options to apply to extracted embed objects.
     */
    protected array $options = [];

    /**
     * Quick access to list of OEmbed providers.
     */
    protected array $oembedProviders = [];

    /**
     * Quick access to list of non-OEmbed providers.
     */
    protected array $regexProviders = [];

    /**
     * Creates OEmbed instance.
     */
    public function __construct(array $config = null)
    {
        if (is_array($config)) {
            $this->setConfig($config);
        }
    }

    /**
     * Parse URL and attempt to fetch embed data
     */
    public function get(string $url): ?Embed
    {
        $extractor = $this->getExtractor($url);

        if (!$extractor) {
            return null;
        }

        $embed = $extractor->fetch();

        if (!$embed) {
            return null;
        }

        $embed->setOptions($this->options)->setAmp($this->amp);

        return $embed;
    }

    /**
     * Set configs.
     */
    public function setConfig(array $config): self
    {
        $this->amp = $config['amp'] ?? false;
        $this->options = $config['options'] ?? [];
        $this->oembedProviders = $config['oembedProviders'] ?? [];
        $this->regexProviders = $config['regexProviders'] ?? [];

        return $this;
    }

    /**
     * Overrides instance options.
     */
    public function withOptions(array $options): self
    {
        $this->options = $options;
        return $this;
    }

    /**
     * Returns AMP mode.
     */
    public function getAmp(): bool
    {
        return $this->amp;
    }

    /**
     * Returns options array.
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * Restores embed from an array.
     */
    public function hydrate(array $data): Embed
    {
        return new Embed(
            $data['type'],
            $data['url'],
            $data['data'],
            $this->options,
            $this->amp
        );
    }

    /**
     * Returns a matched extractor for url.
     */
    protected function getExtractor(string $url): ?Extractor
    {
        foreach ($this->oembedProviders as $endpoint => $provider) {
            if ($this->findProviderMatch($url, $provider)) {
                return new OEmbedExtractor($endpoint, $url);
            }
        }

        foreach ($this->regexProviders as $provider) {
            if ($this->findProviderMatch($url, $provider['urls'])) {
                return new RegexExtractor($provider, $url);
            }
        }

        return null;
    }

    /**
     * Find a url match in provider pattern
     */
    protected function findProviderMatch($url, $patterns): bool
    {
        foreach ($patterns as $pattern) {
            if (!!preg_match($pattern, $url)) {
                return true;
            }
        }
        return false;
    }
}
