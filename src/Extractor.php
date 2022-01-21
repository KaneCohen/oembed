<?php
namespace Cohensive\OEmbed;

abstract class Extractor
{
    public function __construct(
        protected string|array $provider,
        protected string $url,
        protected array $parameters = []
    ) {
    }

    public function fetch(array $parameters = []): ?Embed
    {
        return null;
    }
}
