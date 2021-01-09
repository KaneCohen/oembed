<?php
namespace Cohensive\OEmbed;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class OEmbedExtractor extends Extractor
{
    const SUCCESS = 200;

    protected HttpClientInterface $client;

    public function __construct(string|array $provider, string $url)
    {
        $this->provider = $provider;
        $this->url = $url;
        $this->client = HttpClient::create();
    }

    /**
     * Fetches OEmbed data from provider.
     */
    public function fetch(): ?Embed
    {
        $response = $this->client->request('GET', $this->provider, [
            'query' => [
                'url' => $this->url
            ]
        ]);

        if ($response->getStatusCode() !== self::SUCCESS) {
            return null;
        }

        $data = $response->toArray();

        $embed = new Embed(Embed::TYPE_OEMBED, $this->url, $data);

        return $embed;
    }
}
