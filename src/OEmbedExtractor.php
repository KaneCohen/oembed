<?php
namespace Cohensive\OEmbed;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class OEmbedExtractor extends Extractor
{
    const SUCCESS = 200;

    protected HttpClientInterface $client;

    public function __construct(string $provider, string $url, array $parameters = [])
    {
        $this->provider = $provider;
        $this->url = $url;
        $this->parameters = $parameters;
        $this->client = HttpClient::create();
    }

    /**
     * Fetches OEmbed data from provider.
     */
    public function fetch(array $parameters = []): ?Embed
    {
        $query = array_merge($parameters ?: $this->parameters, ['url' => $this->url]);

        $response = $this->client->request(
            'GET',
            (string) $this->provider,
            [
                'query' => $query
            ]
        );

        if ($response->getStatusCode() !== self::SUCCESS) {
            return null;
        }

        $data = $response->toArray();

        $embed = new Embed(Embed::TYPE_OEMBED, $this->url, $data);

        return $embed;
    }
}
