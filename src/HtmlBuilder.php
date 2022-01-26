<?php
namespace Cohensive\OEmbed;

class HtmlBuilder
{
    const TYPE_RAW = 'raw';
    const TYPE_IFRAME = 'iframe';
    const TYPE_VIDEO = 'video';

    public function __construct(
        protected string $type,
        protected string|array $html,
        protected ?string $script = null
    ) {
    }

    /**
     * Returns current type.
     */
    public function type(): string
    {
        return $this->type;
    }

    /**
     * Returns HTML code for media provider.
     */
    public function html(array $options = [], array $globalOptions = [], bool $amp = false): string
    {
        if (is_array($this->html)) {
            $attrs = $this->applyOptions($this->html, $options, $globalOptions);

            if ($this->type === self::TYPE_IFRAME) {
                return $this->iframe($attrs, $amp);
            }

            if ($this->type === self::TYPE_VIDEO) {
                return $this->video($attrs, $amp);
            }

            return '';
        } else {
            return $this->html;
        }
    }

    /**
     * Return AMP-friendly HTML for media provider.
     */
    public function ampHtml(array $options = [], array $globalOptions = []): string
    {
        return $this->html($options, $globalOptions, true);
    }

    /**
     * Returns URL for a given media provider embed. Returned url type depends on embed type:
     * iframe - string
     * video - string[]
     * raw - null
     */
    public function src(array $options = [], array $globalOptions = []): mixed
    {
        if (is_array($this->html)) {
            $attrs = $this->applyOptions($this->html, $options, $globalOptions);

            if ($this->type === self::TYPE_IFRAME) {
                return $attrs['src'] ?? null;
            }

            if ($this->type === self::TYPE_VIDEO) {
                return array_map(function ($source) {
                    return $source['src'];
                }, $attrs['source']);
            }
        }

        return null;
    }

    /**
     * Constructs <iframe> HTML-element based on array of provider attributes.
     */
    protected function iframe(array $attrs, bool $amp = false): string
    {
        $tag = $amp ? 'amp-iframe' : 'iframe';

        $html = "<$tag";
        foreach ($attrs as $attr => $val) {
            $html .= sprintf(' %s="%s"', $attr, $val);
        }
        $html .= "></$tag>";

        return $html;
    }

    /**
     * Constructs <video> HTML-element based on an array of provider attributes.
     */
    protected function video(array $attrs, bool $amp = false): string
    {
        $tag = $amp ? 'amp-video' : 'video';

        $inner = '';

        $html = "<$tag";
        foreach ($attrs as $attr => $val) {
            if (is_array($val)) {
                foreach ($val as $child) {
                    $inner .= "<$attr";
                    foreach ($child as $iattr => $ival) {
                        $inner .= sprintf(' %s="%s"', $iattr, $ival);
                    }
                    $inner .= ">";
                }
            } else {
                $html .= sprintf(' %s="%s"', $attr, $val);
            }
        }
        $html .= ">";

        $html .= $inner;

        $html .= "</$tag>";

        return $html;
    }

    /**
     * Returns script source if available.
     */
    public function script(): ?string
    {
        return $this->script;
    }

    /**
     * Converts class to an array.
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'html' => $this->html,
        ];
    }

    /**
     * Extracts and returns an array of options for a current HTML element type.
     */
    protected function getTypeOptions(array $options): array
    {
        if (isset($options['html'])) {
            return $options['html'][$this->type] ?? [];
        }

        return [];
    }

    /**
     * Merge and apply local and global options to the provider attributes.
     */
    protected function applyOptions(array $attrs, array $options, array $globalOptions): array
    {
        $options = array_merge($globalOptions['attributes'] ?? [], $options);
        $width = $options['width'] ?? null;
        $height = $options['height'] ?? null;

        if (isset($attrs['width']) && isset($attrs['height'])) {
            $ratio = $attrs['width'] / $attrs['height'];
            $attrs['width'] = $width ?: round(($height ?: $attrs['height']) * $ratio);
            $attrs['height'] = $height ?: round($attrs['width'] / $ratio);
        }

        $typeOptions = $this->getTypeOptions($globalOptions);

        if ($options['autoplay'] ?? false) {
            $attrs['autoplay'] = $options['autoplay'];

            // We can remove autoplay option if type is "iframe" after we change "src" attribute.
            if ($this->type === self::TYPE_IFRAME) {
                $attrs['src'] = $this->addUrlParam($attrs['src'], sprintf('%s=%s', 'autoplay', $attrs['autoplay']));
                unset($options['autoplay']);
                unset($attrs['autoplay']);
            }
        }

        return array_filter(
            array_merge($typeOptions, $options, $attrs),
            function ($v) {
                return $v !== null;
            }
        );
    }

    /**
     * Append custom parameter to the end of the url.
     */
    protected function addUrlParam(string $url, string $param): string
    {
        $operator = strpos($url, '?') >= 0 ? '&' : '?';
        return $url . $operator . $param;
    }
}
