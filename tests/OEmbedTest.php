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

        $this->assertEquals('<iframe width="800" height="452" src="https://www.youtube.com/embed/dQw4w9WgXcQ?feature=oembed" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" sandbox="allow-scripts allow-same-origin allow-presentation" layout="responsive"></iframe>', $embed->html());
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

    public function testOEmbedHydration()
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
                'html' => '<iframe width="200" height="113" src="https://www.youtube.com/embed/dQw4w9WgXcQ?feature=oembed" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
            ]
        ];

        $embed = $this->oembed->hydrate($data);
        $this->assertInstanceOf(Embed::class, $embed);
        $this->assertEquals($data['url'], $embed->url());
    }

    /**
    public function testEmbedUrlSetting()
    {
        $embed = new Embed('http://youtu.be/dQw4w9WgXcQ');

        $embed->setUrl('http://youtube.com/watch?v=QH2-TGUlwu4');
        $this->assertEquals('http://youtube.com/watch?v=QH2-TGUlwu4', $embed->getUrl());
    }


    public function testEmbedUrlSettingWithTimestamp()
    {
        $params = $this->embed->setUrl('http://youtu.be/dQw4w9WgXcQ?t=2m10s')
            ->parseUrl()
            ->getProvider();
        $this->assertEquals('https://www.youtube.com/embed/dQw4w9WgXcQ?rel=0&wmode=transparent&start=130', $params->render->iframe->src);

        $params = $this->embed->setUrl('http://youtu.be/dQw4w9WgXcQ?t=56s')
            ->parseUrl()
            ->getProvider();
        $this->assertEquals('https://www.youtube.com/embed/dQw4w9WgXcQ?rel=0&wmode=transparent&start=56', $params->render->iframe->src);

        $params = $this->embed->setUrl('http://youtu.be/dQw4w9WgXcQ?t=1h20m57s')
            ->parseUrl()
            ->getProvider();
        $this->assertEquals('https://www.youtube.com/embed/dQw4w9WgXcQ?rel=0&wmode=transparent&start=4857', $params->render->iframe->src);


        $params = $this->embed->setUrl('http://youtu.be/dQw4w9WgXcQ?t=1h20m57s')
            ->parseUrl()
            ->getProvider();
        $this->assertEquals('https://www.youtube.com/embed/dQw4w9WgXcQ?rel=0&wmode=transparent&start=4857', $params->render->iframe->src);

        $params = $this->embed->setUrl('http://youtu.be/dQw4w9WgXcQ?x=1&t=24m10s')
            ->parseUrl()
            ->getProvider();
        $this->assertEquals('https://www.youtube.com/embed/dQw4w9WgXcQ?rel=0&wmode=transparent&start=1450', $params->render->iframe->src);

        $params = $this->embed->setUrl('http://youtube.com/watch?v=dQw4w9WgXcQ&t=24m10s')
            ->parseUrl()
            ->getProvider();
        $this->assertEquals('https://www.youtube.com/embed/dQw4w9WgXcQ?rel=0&wmode=transparent&start=1450', $params->render->iframe->src);

        $params = $this->embed->setUrl('http://youtube.com/v/dQw4w9WgXcQ?t=24m10s')
            ->parseUrl()
            ->getProvider();
        $this->assertEquals('https://www.youtube.com/embed/dQw4w9WgXcQ?rel=0&wmode=transparent&start=1450', $params->render->iframe->src);
    }


    public function testEmbedParamAndAttributeSetting()
    {
        $embed = new Embed('http://youtu.be/dQw4w9WgXcQ', array(
            'params' => array(
                'width' => 100
            )
        ));
        $embed->setAttribute('height', 100);
        $embed->setParam('width', 200);

        $this->assertEquals(['height' => 100], $embed->getAttributes());
        $this->assertEquals(['width' => 200], $embed->getParams());
    }


    public function testEmbedProviderSetting()
    {
        $embed = new Embed();
        $providers = require('src/config/config.php');
        $embed->setProviders($providers['providers']);
        $this->assertEquals($providers['providers'], $embed->getProviders());
    }


    public function testEmbedUrlParsing()
    {
        $this->embed->setUrl('http://youtu.be/dQw4w9WgXcQ');
        $this->assertInstanceOf('Cohensive\Embed\Embed', $this->embed->parseUrl());

        $this->embed->setUrl('http://hello.world/videoID');
        $this->assertFalse($this->embed->parseUrl());
    }


    public function testEmbedWithSSLAndSSLProvider()
    {
        $this->embed->setUrl('http://youtu.be/dQw4w9WgXcQ')->parseUrl();
        $this->assertEquals('https://youtu.be/dQw4w9WgXcQ', $this->embed->getProvider()->info->url);
    }

    public function testEmbedWithSSLAndNonSSLProvider()
    {
        $this->embed->setUrl('http://twitch.tv/day9tv')->parseUrl();
        $this->assertEquals('https://twitch.tv/day9tv', $this->embed->getProvider()->info->url);
    }

    public function testEmbedHTMLGeneration()
    {
        $this->embed->setUrl('http://youtu.be/dQw4w9WgXcQ')->parseUrl();

        $this->assertEquals('<iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ?rel=0&wmode=transparent" width="560" height="315" allowfullscreen="" frameborder="0" sandbox="allow-scripts allow-same-origin allow-presentation" layout="responsive"></iframe>', $this->embed->getIframe());
    }

    public function testHTML5VideoGeneration()
    {
        $this->embed->setUrl('http://example.com/hello.mp4')->parseUrl();

        $this->assertEquals('<video width="560" height="315" controls="controls" layout="responsive"><source src="http://example.com/hello.webm" type="video/webm"></source><source src="http://example.com/hello.ogg" type="video/ogg"></source><source src="http://example.com/hello.mp4" type="video/mp4"></source></video>', $this->embed->getHtml());
    }

    public function testAMPEmbedHTMLGeneration()
    {
        $this->embed->setUrl('http://youtu.be/dQw4w9WgXcQ')->parseUrl();
        $this->embed->enableAmpMode();

        $this->assertEquals('<amp-iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ?rel=0&wmode=transparent" width="560" height="315" allowfullscreen="" frameborder="0" sandbox="allow-scripts allow-same-origin allow-presentation" layout="responsive"></amp-iframe>', $this->embed->getIframe());
    }

    public function testAMPHTML5VideoGeneration()
    {
        $this->embed->setUrl('http://example.com/hello.mp4')->parseUrl();

        $this->assertEquals('<amp-video width="560" height="315" controls="controls" layout="responsive"><source src="http://example.com/hello.webm" type="video/webm"></source><source src="http://example.com/hello.ogg" type="video/ogg"></source><source src="http://example.com/hello.mp4" type="video/mp4"></source></amp-video>', $this->embed->getAmpHtml());
    }

    public function testAMPHTML5SSLVideoGeneration()
    {
        $this->embed->setUrl('https://example.com/hello.mp4')->parseUrl();

        $this->assertEquals('<amp-video width="560" height="315" controls="controls" layout="responsive"><source src="https://example.com/hello.webm" type="video/webm"></source><source src="https://example.com/hello.ogg" type="video/ogg"></source><source src="https://example.com/hello.mp4" type="video/mp4"></source></amp-video>', $this->embed->getAmpHtml());
    }

    public function testTwitchParseData()
    {
        $this->embed->setUrl('https://www.twitch.tv/clintstevens/clip/CrispyEndearingCiderBibleThump')->parseUrl();
        $expected = '<iframe src="https://clips.twitch.tv/embed?clip=CrispyEndearingCiderBibleThump&autoplay=false&tt_medium=clips_embed" width="420" height="237" scrolling="no" allowfullscreen="1" frameborder="0" sandbox="allow-scripts allow-popups allow-same-origin allow-presentation" layout="responsive"></iframe>';

        $this->assertEquals($expected, $this->embed->getHtml());
    }

    public function testVimeoParseData()
    {
        $this->embed->setUrl('https://vimeo.com/73116214')->parseUrl()->fetchData();

        $this->assertTrue(is_object($this->embed->getProvider()->data));
        $this->assertEquals('The Mayor of Times Square', $this->embed->getProvider()->data->title);
    }

    public function testYoutubeParseData()
    {
        $config = ['google_api_key' => '123456'];
        $this->embed->setConfig($config)->setUrl('http://youtu.be/dQw4w9WgXcQ')->parseUrl()->fetchData();

        // Expect fail since google api key is incorrect.
        $this->assertFalse(is_object($this->embed->getProvider()->data));
    }
    */
}
