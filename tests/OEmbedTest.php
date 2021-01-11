<?php

use Cohensive\OEmbed\Embed;
use Cohensive\OEmbed\Factory;
use Cohensive\OEmbed\OEmbed;
use PHPUnit\Framework\TestCase;

class OEmbedTest extends TestCase {

    protected $oembed;

    public function setUp(): void
    {
        $this->oembed = (new Factory())->make();
    }

    public function testOEmbedBeingCreated()
    {
        $instance = new OEmbed();
        $this->assertInstanceOf(OEmbed::class, $instance);
        $this->assertEquals(false, $instance->getAmp());
        $this->assertEquals([], $instance->getOptions());

        $instance = new OEmbed([
            'amp' => true,
            'options' => [
                'width' => 100,
            ]
        ]);
        $this->assertInstanceOf(OEmbed::class, $instance);
        $this->assertEquals(true, $instance->getAmp());
        $this->assertEquals(['width' => 100], $instance->getOptions());
    }

    public function testOptionsSetup()
    {
        $instance = new OEmbed();
        $instance->withOptions(['width' => 100]);
        $this->assertEquals(['width' => 100], $instance->getOptions());
    }

    public function testFacotry()
    {
        $factory = new Factory();
        $this->assertInstanceOf(OEmbed::class, $factory->make());
    }

    public function testOEmbedProviderData()
    {
        $url = 'http://youtu.be/dQw4w9WgXcQ';
        $embed = $this->oembed->get($url);

        $this->assertInstanceOf(Embed::class, $embed);

        $data = $embed->data();
        $this->assertTrue(is_array($data));
        $this->assertEquals(Embed::TYPE_OEMBED, $embed->type());
        $this->assertEquals('video', $embed->mediaType());
        $this->assertEquals('Rick Astley - Never Gonna Give You Up (Video)', $data['title']);
        $this->assertEquals($url, $embed->url());
    }

    public function testYouTubeHtmlSizeChange()
    {
        $url = 'http://youtu.be/dQw4w9WgXcQ';
        $embed = $this->oembed->get($url);

        $data = $embed->data();
        $ratio = $data['width'] / $data['height'];
        $width = 1000;
        $height = (int) $width / $ratio;

        // Default width/height is 200/113 as returned by OEmbed.
        $this->assertEquals('<iframe width="200" height="113" src="https://www.youtube.com/embed/dQw4w9WgXcQ?feature=oembed" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" sandbox="allow-scripts allow-same-origin allow-presentation" layout="responsive"></iframe>', $embed->html());
        $this->assertEquals('<iframe width="' . $width . '" height="' . $height . '" src="https://www.youtube.com/embed/dQw4w9WgXcQ?feature=oembed" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" sandbox="allow-scripts allow-same-origin allow-presentation" layout="responsive"></iframe>', $embed->html(['width' => $width]));

        $width = 2000;
        $height = $width / $ratio;
        $this->assertEquals('<iframe width="' . $width . '" height="' . $height . '" src="https://www.youtube.com/embed/dQw4w9WgXcQ?feature=oembed" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" sandbox="allow-scripts allow-same-origin allow-presentation" layout="responsive"></iframe>', $embed->html(['width' => $width]));
    }

    public function testOEmbedProviderFails()
    {
        $url = 'https://example.com/dQw4w9WgXcQ';
        $embed = $this->oembed->get($url);

        $this->assertNull($embed);
    }

    public function testOEmbedProviderHtml()
    {
        $url = 'http://youtu.be/dQw4w9WgXcQ';
        $embed = $this->oembed->get($url);

        $this->assertTrue(is_string($embed->html()));
    }

    public function testOEmbedTwitter()
    {
        $url = 'https://twitter.com/DariuszPrzada/status/1333130982774468608';
        $embed = $this->oembed->get($url);

        $this->assertEquals(0, strpos($embed->html(), '<blockquote'));
    }

    public function testRegexProviderData()
    {
        $url = 'https://example.com/hello.mp4';
        $embed = $this->oembed->get($url);

        $data = $embed->data();
        $this->assertInstanceOf(Embed::class, $embed);
        $this->assertEquals(Embed::TYPE_REGEX, $embed->type());
        $this->assertEquals($url, $embed->url());
        $this->assertFalse(isset($data['title']));
    }

    public function testRegexProviderHtml()
    {
        $url = 'https://example.com/hello.mp4';
        $embed = $this->oembed->get($url);
        $html = '<video controls="controls" layout="responsive"><source src="https://example.com/hello.webm" type="video/webm"><source src="https://example.com/hello.ogg" type="video/ogg"><source src="https://example.com/hello.mp4" type="video/mp4"></video>';
        $ampHtml = '<amp-video controls="controls" layout="responsive"><source src="https://example.com/hello.webm" type="video/webm"><source src="https://example.com/hello.ogg" type="video/ogg"><source src="https://example.com/hello.mp4" type="video/mp4"></amp-video>';

        $this->assertTrue(is_string($embed->html()));
        $this->assertEquals($html, $embed->html());
        $this->assertEquals($ampHtml, $embed->ampHtml());
    }
}
