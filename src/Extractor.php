<?php
namespace Cohensive\OEmbed;

abstract class Extractor
{
    public function __construct(
        protected string|array $provider,
        protected string $url
    ) {
    }

    public function fetch(): ?Embed
    {
        return null;
    }
}
