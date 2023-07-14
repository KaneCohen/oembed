<?php

use Cohensive\OEmbed\Embed;
use Cohensive\OEmbed\Factory;
use Cohensive\OEmbed\OEmbed;
use PHPUnit\Framework\TestCase;

class OEmbedTest extends TestCase
{
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
        $this->assertEquals('Rick Astley - Never Gonna Give You Up (Official Music Video)', $data['title']);
        $this->assertEquals($url, $embed->url());
    }

    public function testOEmbedHtmlUrl()
    {
        $url = 'http://youtu.be/dQw4w9WgXcQ';
        $embed = $this->oembed->get($url);

        $this->assertEquals('https://www.youtube.com/embed/dQw4w9WgXcQ?feature=oembed', $embed->src());
    }

    public function testOEmbedTwitchUrl()
    {
        $url = 'https://clips.twitch.tv/NastyNaiveOysterOSsloth-pvt3cTngOPKyXWuf';
        $embed = $this->oembed->get($url);

        $this->assertEquals('https://clips.twitch.tv/embed?clip=NastyNaiveOysterOSsloth-pvt3cTngOPKyXWuf&autoplay=false&tt_medium=clips_embed&parent=www.example.com', $embed->src());
    }

    public function testOEmbedHtmlUrlAutoplay()
    {
        $url = 'http://youtu.be/dQw4w9WgXcQ';
        $embed = $this->oembed->get($url);

        $this->assertEquals('https://www.youtube.com/embed/dQw4w9WgXcQ?feature=oembed&autoplay=1', $embed->src(['autoplay' => 1]));
    }

    public function testYouTubeHtmlSizeChange()
    {
        $url = 'http://youtu.be/dQw4w9WgXcQ';
        $embed = $this->oembed->get($url);

        $data = $embed->data();
        $ratio = $data['width'] / $data['height'];
        $width = 1000;
        $height = round($width / $ratio);

        $this->assertEquals('<iframe sandbox="allow-scripts allow-popups allow-same-origin allow-presentation" layout="responsive" width="560" height="315" src="https://www.youtube.com/embed/dQw4w9WgXcQ?feature=oembed" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="" title="Rick Astley - Never Gonna Give You Up (Official Music Video)"></iframe>', $embed->html());
        $this->assertEquals('<iframe sandbox="allow-scripts allow-popups allow-same-origin allow-presentation" layout="responsive" width="' . $width . '" height="' . $height . '" src="https://www.youtube.com/embed/dQw4w9WgXcQ?feature=oembed" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="" title="Rick Astley - Never Gonna Give You Up (Official Music Video)"></iframe>', $embed->html(['width' => $width]));

        $width = 2000;
        $height = $width / $ratio;
        $this->assertEquals('<iframe sandbox="allow-scripts allow-popups allow-same-origin allow-presentation" layout="responsive" width="' . $width . '" height="' . $height . '" src="https://www.youtube.com/embed/dQw4w9WgXcQ?feature=oembed" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="" title="Rick Astley - Never Gonna Give You Up (Official Music Video)"></iframe>', $embed->html(['width' => $width]));
    }

    public function testYouTubeHtmlAutoplay()
    {
        $url = 'http://youtu.be/dQw4w9WgXcQ';
        $embed = $this->oembed->get($url);

        $this->assertEquals('<iframe sandbox="allow-scripts allow-popups allow-same-origin allow-presentation" layout="responsive" width="560" height="315" src="https://www.youtube.com/embed/dQw4w9WgXcQ?feature=oembed&autoplay=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="" title="Rick Astley - Never Gonna Give You Up (Official Music Video)"></iframe>', $embed->html(['autoplay' => true]));
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

    public function testOEmbedInUtf8()
    {
        $url = 'https://youtu.be/G28SocqOwOE';
        $embed = $this->oembed->get($url);

        $this->assertEquals('<iframe sandbox="allow-scripts allow-popups allow-same-origin allow-presentation" layout="responsive" width="560" height="315" src="https://www.youtube.com/embed/G28SocqOwOE?feature=oembed" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="" title="الأندرتيكر | الدحيح"></iframe>', $embed->html());
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

    public function testRegexProviderUrl()
    {
        $url = 'https://example.com/hello.mp4';
        $embed = $this->oembed->get($url);

        $this->assertEquals([
            'https://example.com/hello.webm',
            'https://example.com/hello.ogg',
            'https://example.com/hello.mp4',
        ], $embed->src());
    }

    public function testRegexProviderHtml()
    {
        $url = 'https://example.com/hello.mp4';
        $embed = $this->oembed->get($url);
        $html = '<video controls="controls" layout="responsive" width="600" height="339"><source src="https://example.com/hello.webm" type="video/webm"><source src="https://example.com/hello.ogg" type="video/ogg"><source src="https://example.com/hello.mp4" type="video/mp4"></video>';
        $ampHtml = '<amp-video controls="controls" layout="responsive" width="600" height="339"><source src="https://example.com/hello.webm" type="video/webm"><source src="https://example.com/hello.ogg" type="video/ogg"><source src="https://example.com/hello.mp4" type="video/mp4"></amp-video>';

        $this->assertTrue(is_string($embed->html()));
        $this->assertEquals($html, $embed->html());
        $this->assertEquals($ampHtml, $embed->ampHtml());
    }

    public function testRegexProviderHtmlWithAutoplay()
    {
        $url = 'https://example.com/hello.mp4';
        $embed = $this->oembed->get($url);
        $html = '<video controls="controls" layout="responsive" width="600" height="339" autoplay="autoplay"><source src="https://example.com/hello.webm" type="video/webm"><source src="https://example.com/hello.ogg" type="video/ogg"><source src="https://example.com/hello.mp4" type="video/mp4"></video>';
        $ampHtml = '<amp-video controls="controls" layout="responsive" width="600" height="339" autoplay="autoplay"><source src="https://example.com/hello.webm" type="video/webm"><source src="https://example.com/hello.ogg" type="video/ogg"><source src="https://example.com/hello.mp4" type="video/mp4"></amp-video>';

        $this->assertTrue(is_string($embed->html()));
        $this->assertEquals($html, $embed->html(['autoplay' => 'autoplay']));
        $this->assertEquals($ampHtml, $embed->ampHtml(['autoplay' => 'autoplay']));
    }

    public function testOembedScriptTag()
    {
        $html = '<blockquote class="tiktok-embed" cite="https://www.tiktok.com/@chrisgamescg/video/7037241761818742021" data-video-id="7037241761818742021" data-embed-from="oembed" style="max-width: 605px;min-width: 325px;" > <section> <a target="_blank" title="@chrisgamescg" href="https://www.tiktok.com/@chrisgamescg?refer=embed">@chrisgamescg</a> <p>You just been rickrolled <a title="rickroll" target="_blank" href="https://www.tiktok.com/tag/rickroll?refer=embed">#rickroll</a> <a title="rickastley" target="_blank" href="https://www.tiktok.com/tag/rickastley?refer=embed">#rickastley</a> <a title="SpotifyWrapped" target="_blank" href="https://www.tiktok.com/tag/SpotifyWrapped?refer=embed">#SpotifyWrapped</a> <a title="HONOR50duet" target="_blank" href="https://www.tiktok.com/tag/HONOR50duet?refer=embed">#HONOR50duet</a> <a title="comedy" target="_blank" href="https://www.tiktok.com/tag/comedy?refer=embed">#comedy</a> <a title="meme" target="_blank" href="https://www.tiktok.com/tag/meme?refer=embed">#meme</a> <a title="funny" target="_blank" href="https://www.tiktok.com/tag/funny?refer=embed">#funny</a> <a title="trending" target="_blank" href="https://www.tiktok.com/tag/trending?refer=embed">#trending</a> <a title="lol" target="_blank" href="https://www.tiktok.com/tag/lol?refer=embed">#lol</a> <a title="twitch" target="_blank" href="https://www.tiktok.com/tag/twitch?refer=embed">#twitch</a> <a title="original" target="_blank" href="https://www.tiktok.com/tag/original?refer=embed">#original</a></p> <a target="_blank" title="♬ I Can Feel It (Christmas Instrumental) - Nick Sena and Danny Echevarria" href="https://www.tiktok.com/music/I-Can-Feel-It-Christmas-Instrumental-6777559167281399809?refer=embed">♬ I Can Feel It (Christmas Instrumental) - Nick Sena and Danny Echevarria</a> </section> </blockquote> <script async src="https://www.tiktok.com/embed.js"></script>';
        $url = 'https://www.tiktok.com/@chrisgamescg/video/7037241761818742021';
        $embed = $this->oembed->get($url);
        $script = 'https://www.tiktok.com/embed.js';

        $this->assertEquals($html, $embed->html());
        $this->assertEquals($script, $embed->script());
    }

    public function testOEmbedParameters()
    {
        $url = 'https://twitter.com/hunter11_wolf/status/1484450337247404034';
        $embed = $this->oembed->get($url, ['theme' => 'dark']);
        $html = '<blockquote class="twitter-tweet" data-theme="dark"><p lang="qme" dir="ltr"> <a href="https://t.co/EKXsyw0IdU">pic.twitter.com/EKXsyw0IdU</a></p>&mdash; Night&#39;s Cavalry (@hunter11_wolf) <a href="https://twitter.com/hunter11_wolf/status/1484450337247404034?ref_src=twsrc%5Etfw">January 21, 2022</a></blockquote>'. "\n" . '<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>' . "\n";

        $this->assertEquals($html, $embed->html());

        $url = 'https://twitter.com/hunter11_wolf/status/1484450337247404034';
        $embed = $this->oembed->get($url, ['theme' => 'light']);
        $html = '<blockquote class="twitter-tweet" data-theme="light"><p lang="qme" dir="ltr"> <a href="https://t.co/EKXsyw0IdU">pic.twitter.com/EKXsyw0IdU</a></p>&mdash; Night&#39;s Cavalry (@hunter11_wolf) <a href="https://twitter.com/hunter11_wolf/status/1484450337247404034?ref_src=twsrc%5Etfw">January 21, 2022</a></blockquote>'. "\n" . '<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>' . "\n";

        $this->assertEquals($html, $embed->html());
    }
}
