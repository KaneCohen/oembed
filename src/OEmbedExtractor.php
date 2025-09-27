<?php
namespace Cohensive\OEmbed;

use Cohensive\OEmbed\Exceptions\ExtractorException;

class OEmbedExtractor extends Extractor
{
    public function __construct(string $provider, string $url, array $parameters = [])
    {
        $this->provider = $provider;
        $this->url = $url;
        $this->parameters = $parameters;
    }

    /**
     * Fetches OEmbed data from provider.
     */
    public function fetch(array $parameters = []): ?Embed
    {
        $requestUrl = $this->buildRequestUrl($parameters);
        $response = file_get_contents($requestUrl);

        if (!$response) {
            return null;
        }

        $oembedData = json_decode($response, true);

        if (!$oembedData) {
            throw new ExtractorException('Invalid JSON response from OEmbed provider. Url: ' . $this->url);
        }

        return new Embed(Embed::TYPE_OEMBED, $this->url, $oembedData);
    }

    /**
     * Builds the complete request URL with all parameters.
     */
    private function buildRequestUrl(array $parameters = []): string
    {
        $baseUrl = explode('?', $this->provider)[0];
        $existingParams = $this->extractExistingParams();
        $finalParams = $this->mergeAllParameters($existingParams, $parameters);
        return $baseUrl . '?' . http_build_query($finalParams);
    }

    /**
     * Extracts existing query parameters from the provider URL.
     */
    private function extractExistingParams(): array
    {
        $queryString = parse_url($this->provider, PHP_URL_QUERY);
        $existingParams = [];

        if ($queryString) {
            parse_str($queryString, $existingParams);
        }

        return $existingParams;
    }

    /**
     * Merges all parameters in the correct priority order.
     */
    private function mergeAllParameters(array $existingParams, array $parameters): array
    {
        $requestParams = $parameters ?: $this->parameters;
        $mandatoryParams = ['url' => $this->url];

        return array_merge($existingParams, $requestParams, $mandatoryParams);
    }
}
