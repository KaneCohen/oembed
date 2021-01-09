<?php
namespace Cohensive\OEmbed;

class EmbedHtml
{
    public function __construct(
        protected string $type,
        protected string|array $html
    ) {
    }

    /**
     * Returns HTML code for media provider.
     */
    public function html(array $options = [], bool $amp = false): string
    {
        if (is_array($this->html)) {
            $attrs = $this->applyOptions($this->html, $options);
        }

        if ($this->type === 'iframe') {
            return $this->iframe($attrs, $amp);
        }

        if ($this->type === 'video') {
            return $this->video($attrs, $amp);
        }

        return $this->html;
    }

    /**
     * Return AMP-friendly HTML for media provider.
     *
     * @param array $options
     * @return string
     */
    public function ampHtml(array $options = []): string
    {
        return $this->html($options, true);
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
     *
     * @param array $attrs
     * @param boolean $amp
     * @return void
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
     * Merge and apply local and global options to the provider attributes.
     */
    protected function applyOptions(array $attrs, array $options): array
    {
        if (isset($attrs['width']) && isset($attrs['height'])) {
            $ratio = $attrs['width'] / $attrs['height'];

            if (isset($options['width']) && !isset($options['height'])) {
                $attrs['width'] = $options['width'];
                $attrs['height'] = (int) $options['width'] / $ratio;
            }

            if (isset($options['height']) && !isset($options['width'])) {
                $attrs['height'] = $options['height'];
                $attrs['width'] = (int) $options['height'] * $ratio;
            }
        }

        if ($options) {
            $elementOptions = $options['html'][$this->type] ?? [];
            $attrs = array_merge($attrs, $elementOptions);
        }

        return $attrs;
    }
}
