<?php

use Cohensive\OEmbed\Embed;
use Cohensive\OEmbed\Exceptions\HtmlParsingException;
use Cohensive\OEmbed\Factory;
use Cohensive\OEmbed\HtmlBuilder;
use Cohensive\OEmbed\OEmbed;
use PHPUnit\Framework\TestCase;

class EmbedTest extends TestCase
{
    protected OEmbed $oembed;

    protected $data = [
        'type' => Embed::TYPE_OEMBED,
        'url' => 'http://youtu.be/dQw4w9WgXcQ',
        'data' => [
            'title' => 'Rick Astley - Never Gonna Give You Up (Video)',
            'author_name' => 'RickAstleyVEVO',
            'author_url' => 'https://www.youtube.com/user/RickAstleyVEVO',
            'type' => 'video',
            'height' => 113,
            'width' => 200,
            'version' => '1.0',
            'provider_name' => 'YouTube',
            'provider_url' => 'https://www.youtube.com/',
            'thumbnail_height' => 360,
            'thumbnail_width' => 480,
            'thumbnail_url' => 'https://i.ytimg.com/vi/dQw4w9WgXcQ/hqdefault.jpg',
            'html' => '<iframe width="200" height="113" src="https://www.youtube.com/embed/dQw4w9WgXcQ?feature=oembed" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
        ]
    ];

    public function setUp(): void
    {
        $this->embed = (new Factory())->make()->hydrate($this->data);
    }

    public function testHtmlParsingError()
    {
        $data = [
            'type' => Embed::TYPE_OEMBED,
            'url' => 'http://youtu.be/dQw4w9WgXcQ',
            'data' => [
                'title' => 'Rick Astley - Never Gonna Give You Up (Video)',
                'author_name' => 'RickAstleyVEVO',
                'author_url' => 'https://www.youtube.com/user/RickAstleyVEVO',
                'type' => 'video',
                'height' => 113,
                'width' => 200,
                'version' => '1.0',
                'provider_name' => 'YouTube',
                'provider_url' => 'https://www.youtube.com/',
                'thumbnail_height' => 360,
                'thumbnail_width' => 480,
                'thumbnail_url' => 'https://i.ytimg.com/vi/dQw4w9WgXcQ/hqdefault.jpg',
                'html' => '</div>'
            ]
        ];

        $this->expectException(HtmlParsingException::class);

        (new OEmbed())->hydrate($data);
    }

    public function testOEmbedHydration()
    {
        $this->assertInstanceOf(Embed::class, $this->embed);
        $this->assertEquals($this->data['url'], $this->embed->url());
    }

    public function testEmbedThumbnail()
    {
        $this->assertTrue($this->embed->hasThumbnail());
        $this->assertTrue(is_array($this->embed->thumbnail()));
        $this->assertEquals($this->data['data']['thumbnail_url'], $this->embed->thumbnailUrl());
        $this->assertEquals($this->data['data']['thumbnail_width'], $this->embed->thumbnailWidth());
        $this->assertEquals($this->data['data']['thumbnail_height'], $this->embed->thumbnailHeight());
    }

    public function testEmbedArrayAndJson()
    {
        $this->assertEquals($this->data, $this->embed->toArray());
        $this->assertEquals(json_encode($this->data), $this->embed->toJson());
    }

    public function testHtmlBuilderClass()
    {
        $this->assertInstanceOf(HtmlBuilder::class, $this->embed->htmlBuilder());
        $this->assertEquals('iframe', $this->embed->htmlBuilder()->type());
        $this->assertEquals('iframe', $this->embed->htmlType());
    }

    public function testEmbedDimensions()
    {
        $this->assertEquals(560, $this->embed->width());
        $this->assertEquals(315, $this->embed->height());
    }
}
