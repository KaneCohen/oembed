<?php
namespace Cohensive\OEmbed;

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
        $data = array_merge($parameters ?: $this->parameters, ['url' => $this->url]);
        $query = http_build_query($data);
        $response = file_get_contents((string) $this->provider . '?' . $query);

        if (!$response) {
            return null;
        }

        $data = json_decode($response, true);

        $embed = new Embed(Embed::TYPE_OEMBED, $this->url, $data);

        return $embed;
    }
}
