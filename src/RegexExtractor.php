<?php
namespace Cohensive\OEmbed;

class RegexExtractor extends Extractor
{
    /**
     * Fetches data from provider.
     */
    public function fetch(): ?Embed
    {
        $data = $this->provider['data'];

        foreach ($this->provider['urls'] as $pattern) {
            preg_match($pattern, $this->url, $matches);
        }

        $protocol = $this->getProtocol();

        $data = $this->hydrateProvider($data, $matches, $protocol);

        return new Embed(Embed::TYPE_REGEX, $this->url, $data);
    }

    /**
     * Get protocol for current url and provider.
     */
    protected function getProtocol(): string
    {
        if ($this->provider['ssl']) {
            return 'https';
        } elseif (strpos($this->url, 'https://') === 0) {
            return 'https';
        } else {
            return 'http';
        }
    }

    /**
     * Parse found provider and replace {x} parts with parsed code.
     */
    protected function hydrateProvider(array &$data, array $matches, string $protocol): array
    {
        // Check if we have an iframe creation array.
        foreach ($data as $key => $val) {
            if (is_array($val)) {
                $data[$key] = $this->hydrateProvider($val, $matches, $protocol);
            } else {
                $data[$key] = str_replace('{protocol}', $protocol, $data[$key]);
                for ($i = 1; $i < count($matches); $i++) {
                    $data[$key] = str_replace('{' . $i . '}', $matches[$i], $data[$key]);
                }
            }
        }

        return $data;
    }
}
