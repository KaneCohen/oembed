<?php
namespace Cohensive\OEmbed;

use Cohensive\OEmbed\Exceptions\HtmlParsingException;
use DOMDocument;

class Embed
{
    const TYPE_OEMBED = 0;

    const TYPE_REGEX = 1;

    /**
     * Type of an Embed object source data - OEmbed or Regex-based.
     */
    protected int $type;

    /**
     * Array of global options applied to embed objects.
     */
    protected array $options;

    /**
     * Original media URL.
     */
    protected string $url;

    /**
     * Embed data extracted via OEmbed or Regex extractors.
     */
    protected array $data;

    /**
     * Class containing Embed HTML code.
     */
    protected HtmlBuilder $html;

    /**
     * Thumbnail data if available.
     */
    protected ?array $thumbnail;

    /**
     * Creates Embed instance.
     */
    public function __construct(
        string $type,
        string $url,
        array $data,
        array $options = [],
        bool $amp = false
    ) {
        $this->type = $type;
        $this->url = $url;
        $this->data = $data;
        $this->options = $options;
        $this->amp = $amp;

        $this->initData($data);
    }

    /**
     * Initializer for the Embed object filling thumbnail, html and type based
     * on a given media provider data.
     */
    public function initData(array $data): self
    {
        if (isset($data['thumbnail_url'])) {
            $this->thumbnail = [
                'url' => $data['thumbnail_url'],
                'width' => $data['thumbnail_width'] ?? null,
                'height' => $data['thumbnail_height'] ?? null,
            ];
        }

        if ($this->type == self::TYPE_OEMBED) {
            $this->html = $this->extractOEmbedHtml($data['html']);
        } else {
            $this->html = $this->extractRegexHtml($data['html']);
        }

        return $this;
    }

    /**
     * Returns mbed options.
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * Sets new embed options. See config file 'options' key.
     */
    public function setOptions(array $options): self
    {
        $this->options = $options;
        return $this;
    }

    /**
     * Sets AMP mode.
     */
    public function setAmp(bool $amp): self
    {
        $this->amp = $amp;
        return $this;
    }

    /**
     * Returns current HtmlBuilder instance.
     */
    public function htmlBuilder(): HtmlBuilder
    {
        return $this->html;
    }

    /**
     * Returns string with HTML to embed in application. Will return AMP-friendly
     * HTML if global amp mode is enabled and not overwitten.
     */
    public function html(array $options = null, ?bool $amp = null): string
    {
        if (is_null($options)) {
            $options = $this->options;
        } else {
            $options = array_merge($this->options, $options);
        }

        if (is_null($amp)) {
            $amp = $this->amp;
        }

        return $this->html->html($options, $amp);
    }

    /**
     * Returns string with AMP-friendly HTML to embed in an application.
     */
    public function ampHtml(array $options = null): string
    {
        return $this->html($options, true);
    }

    /**
     * Return script source if available in embed html.
     */
    public function script(): ?string
    {
        return $this->html->script();
    }

    /**
     * Returns embed provider type.
     */
    public function type(): int
    {
        return $this->type;
    }

    /**
     * Returns embed html type.
     */
    public function htmlType(): string
    {
        return $this->html->type();
    }

    /**
     * Returns media provider data.
     */
    public function url(): string
    {
        return $this->url;
    }

    /**
     * Returns media provider data.
     */
    public function data(): array
    {
        return $this->data;
    }

    /**
     * Returns string describing media type. According to OEmbed spec it could be:
     * one of these: photo, video, link, rich
     */
    public function mediaType(): string
    {
        return $this->data['type'];
    }

    /**
     * Returns boolean flag telling if given embed data has a thumbnail.
     */
    public function hasThumbnail(): bool
    {
        return is_array($this->thumbnail);
    }

    /**
     * Returns thumbnail data in an array form containing url and its dimensions.
     *
     */
    public function thumbnail(): ?array
    {
        return $this->thumbnail;
    }

    /**
     * Reutrns string for thumbnail or null if it's not set.
     */
    public function thumbnailUrl(): ?string
    {
        return $this->hasThumbnail() ? $this->thumbnail['url'] : null;
    }

    /**
     * Return thumbnail width or 0 if not set.
     */
    public function thumbnailWidth(): int
    {
        return $this->hasThumbnail() ? $this->thumbnail['width'] : 0;
    }

    /**
     * Return thumbnail height or 0 if not set.
     */
    public function thumbnailHeight(): int
    {
        return $this->hasThumbnail() ? $this->thumbnail['height'] : 0;
    }

    /**
     * Converts Embed instance into an array for caching.
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'url' => $this->url,
            'data' => $this->data,
        ];
    }

    /**
     * Converts Embed instance into json string.
     */
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }

    /**
     * Returns HtmlBuilder instance of OEmbed media provider HTML string.
     */
    protected function extractOEmbedHtml(string $html): HtmlBuilder
    {
        $script = null;
        $doc = new DOMDocument();
        $doc->loadHTML("<html><body>$html</body></html>", LIBXML_NOERROR);
        $body = $doc->documentElement->lastChild;

        $scripts = $body->getElementsByTagName('script');
        foreach ($scripts as $node) {
            $script = $node->getAttribute('src');
            break;
        }

        if (!$body->firstChild) {
            throw new HtmlParsingException();
        }

        if ($body->firstChild && $body->firstChild->nodeName === 'iframe') {
            $attrs = [];

            foreach ($body->firstChild->attributes as $attribute) {
                $attrs[$attribute->name] = $attribute->value;
            }

            return new HtmlBuilder(HtmlBuilder::TYPE_IFRAME, $attrs, $script);
        }

        return new HtmlBuilder(HtmlBuilder::TYPE_RAW, $html, $script);
    }

    /**
     * Returns HtmlBuilder instance of Regex media provider HTML string.
     */
    protected function extractRegexHtml(array $html): HtmlBuilder
    {
        $type = array_key_first($html);
        return new HtmlBuilder($type, $html[$type]);
    }
}
