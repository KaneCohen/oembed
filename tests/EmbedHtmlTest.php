<?php

use Cohensive\OEmbed\Embed;
use Cohensive\OEmbed\HtmlBuilder;
use Cohensive\OEmbed\OEmbed;
use PHPUnit\Framework\TestCase;

class HtmlBuilderTest extends TestCase
{
    protected $oembed;

    protected $attrs = [
        'width' => 200,
        'height' => 113,
        'src' => 'https://www.youtube.com/embed/dQw4w9WgXcQ?feature=oembed',
        'frameborder' => 0,
        'allow' => 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture',
        'allowfullscreen' => ''
    ];

    public function setUp(): void
    {
        $this->html = new HtmlBuilder('iframe', $this->attrs);
    }

    public function testInstance()
    {
        $this->assertInstanceOf(HtmlBuilder::class, $this->html);
    }

    public function tesToArray()
    {
        $this->assertEquals(['type' => 'iframe', 'html' => $this->attrs], $this->html->toArray());
    }

    public function testHtmlGeneration()
    {
        $iframe = '<iframe width="200" height="113" src="https://www.youtube.com/embed/dQw4w9WgXcQ?feature=oembed" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>';
        $this->assertEquals($iframe, $this->html->html());

        $iframe = '<iframe width="300" height="170" src="https://www.youtube.com/embed/dQw4w9WgXcQ?feature=oembed" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>';
        $this->assertEquals($iframe, $this->html->html(['width' => 300]));

        $iframe = '<amp-iframe width="300" height="170" src="https://www.youtube.com/embed/dQw4w9WgXcQ?feature=oembed" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></amp-iframe>';
        $this->assertEquals($iframe, $this->html->html(['width' => 300], [], true));
        $this->assertEquals($iframe, $this->html->ampHtml(['width' => 300]));

        $iframe = '<iframe foo="bar" width="200" height="113" src="https://www.youtube.com/embed/dQw4w9WgXcQ?feature=oembed" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>';
        $options = [
            'foo' => 'bar'
        ];
        $this->assertEquals($iframe, $this->html->html($options));
    }
}
