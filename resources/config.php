<?php

return [

    /**
     *--------------------------------------------------------------------------
     * AMP Mode
     *--------------------------------------------------------------------------
     *
     * Return AMP-compatible html code.
     *
     */
    'amp' => false,

    /**
     *--------------------------------------------------------------------------
     * Ignore HTTP Errors
     *--------------------------------------------------------------------------
     *
     * When set, will ignore exceptions that might occur during HTTP requests
     * to oembed providers.
     *
     */
    'ignore_http_errors' => true,

    /**
     *--------------------------------------------------------------------------
     * Embed Options
     *--------------------------------------------------------------------------
     *
     * Global Options which could be applied to embed code.
     *
     */
    'options' => [
        // Attributes which will be assigned to generated html.
        'attributes' => [
            // Sets global embed width where applicable. If set to null - will be
            // automatically calculated if global height is set.
            'width' => null,

            // Sets global embed height where applicable. If set to null - will be
            // automatically calculated if global width is set.
            'height' => null,
        ],

        // Sets global embed html attributes.
        'html' => [
            'iframe' => [
                'sandbox' => 'allow-scripts allow-popups allow-same-origin allow-presentation',
                'layout' => 'responsive',
            ],
            'video' => [
                'controls' => 'controls',
                'layout' => 'responsive',
            ]
        ],

        // Individual provider options that override fetched data.
        'providers' => [
            'YouTube' => [
                'data' => [
                    'width' => 560,
                    'height' => 315,
                ],
                'html' => [
                    'width' => 560,
                    'height' => 315,
                ]
            ],
        ]
    ],

    /**
     *--------------------------------------------------------------------------
     * OEmbed Media Providers
     *--------------------------------------------------------------------------
     *
     * List of OEmbed media providers used to construct embed elements.
     *
     * Providers can include "parameters" key to specify some extra paramters
     * that will be submitted to endpoint:
     *
     * 'https://publish.twitter.com/oembed' => [
     *       'schemes' => [
     *            ...
     *       ],
     *       'parameters' => [
     *            'theme => 'light
     *       ]
     *   ],
     *
     */
    'oembed_providers' => [
        'http://www.23hq.com/23/oembed' => [
            'schemes' => [
                '|^https?://www\\.23hq\\.com/.*/photo/.*$|i',
            ]
        ],
        'https://api.abraia.me/oembed' => [
            'schemes' => [
                '|^https?://store\\.abraia\\.me/.*$|i',
            ]
        ],
        'https://secure.actblue.com/cf/oembed' => [
            'schemes' => [
                '|^https?://secure\\.actblue\\.com/donate/.*$|i',
            ]
        ],
        'http://play.adpaths.com/oembed/*' => [
            'schemes' => [
                '|^https?://play\\.adpaths\\.com/experience/.*$|i',
            ]
        ],
        'https://openapi.afreecatv.com/oembed/embedinfo' => [
            'schemes' => [
                '|^https?://v\\.afree\\.ca/ST/$|i',
                '|^https?://vod\\.afreecatv\\.com/ST/$|i',
                '|^https?://vod\\.afreecatv\\.com/PLAYER/STATION/$|i',
                '|^https?://play\\.afreecatv\\.com/$|i',
            ]
        ],
        'https://viewer.altium.com/shell/oembed' => [
            'schemes' => [
                '|^https?://altium\\.com/viewer/.*$|i',
            ]
        ],
        'https://api.altrulabs.com/api/v1/social/oembed' => [
            'schemes' => [
                '|^https?://app\\.altrulabs\\.com/.*/.*\\?answer_id\\=.*$|i',
                '|^https?://app\\.altrulabs\\.com/player/.*$|i',
            ]
        ],
        'https://live.amcharts.com/oembed' => [
            'schemes' => [
                '|^https?://live\\.amcharts\\.com/.*$|i',
                '|^https?://live\\.amcharts\\.com/.*$|i',
            ]
        ],
        'https://animatron.com/oembed/json' => [
            'schemes' => [
                '|^https?://www\\.animatron\\.com/project/.*$|i',
                '|^https?://animatron\\.com/project/.*$|i',
            ]
        ],
        'http://animoto.com/oembeds/create' => [
            'schemes' => [
                '|^https?://animoto\\.com/play/.*$|i',
            ]
        ],
        'https://api.anniemusic.app/api/v1/oembed' => [
            'schemes' => [
                '|^https?://anniemusic\\.app/t/.*$|i',
                '|^https?://anniemusic\\.app/p/.*$|i',
            ]
        ],
        'https://display.apester.com/oembed' => [
            'schemes' => [
                '|^https?://renderer\\.apester\\.com/v2/.*\\?preview\\=true&iframe_preview\\=true$|i',
            ]
        ],
        'https://storymaps.arcgis.com/oembed' => [
            'schemes' => [
                '|^https?://storymaps\\.arcgis\\.com/stories/.*$|i',
            ]
        ],
        'https://app.archivos.digital/oembed/' => [
            'schemes' => [
                '|^https?://app\\.archivos\\.digital/app/view/.*$|i',
            ]
        ],
        'https://audioboom.com/publishing/oembed/v4.json' => [
            'schemes' => [
                '|^https?://audioboom\\.com/channels/.*$|i',
                '|^https?://audioboom\\.com/channel/.*$|i',
                '|^https?://audioboom\\.com/posts/.*$|i',
            ]
        ],
        'https://audioclip.naver.com/oembed' => [
            'schemes' => [
                '|^https?://audioclip\\.naver\\.com/channels/.*/clips/.*$|i',
                '|^https?://audioclip\\.naver\\.com/audiobooks/.*$|i',
            ]
        ],
        'https://audiomack.com/oembed' => [
            'schemes' => [
                '|^https?://audiomack\\.com/.*/song/.*$|i',
                '|^https?://audiomack\\.com/.*/album/.*$|i',
                '|^https?://audiomack\\.com/.*/playlist/.*$|i',
            ]
        ],
        'https://podcasts.audiomeans.fr/services/oembed' => [
            'schemes' => [
                '|^https?://podcasts\\.audiomeans\\.fr/.*$|i',
            ]
        ],
        'https://stage-embed.avocode.com/api/oembed' => [
            'schemes' => [
                '|^https?://app\\.avocode\\.com/view/.*$|i',
            ]
        ],
        'https://backtracks.fm/oembed' => [
            'schemes' => [
                '|^https?://backtracks\\.fm/.*/.*/e/.*$|i',
                '|^https?://backtracks\\.fm/.*/s/.*/.*$|i',
                '|^https?://backtracks\\.fm/.*/.*/.*/.*/e/.*/.*$|i',
                '|^https?://backtracks\\.fm/.*$|i',
                '|^https?://backtracks\\.fm/.*$|i',
            ]
        ],
        'https://blackfire.io/oembed' => [
            'schemes' => [
                '|^https?://blackfire\\.io/profiles/.*/graph$|i',
                '|^https?://blackfire\\.io/profiles/compare/.*/graph$|i',
            ]
        ],
        'https://blogcast.host/oembed' => [
            'schemes' => [
                '|^https?://blogcast\\.host/embed/.*$|i',
                '|^https?://blogcast\\.host/embedly/.*$|i',
            ]
        ],
        'https://view.briovr.com/api/v1/worlds/oembed/' => [
            'schemes' => [
                '|^https?://view\\.briovr\\.com/api/v1/worlds/oembed/.*$|i',
            ]
        ],
        'https://buttondown.email/embed' => [
            'schemes' => [
                '|^https?://buttondown\\.email/.*$|i',
            ]
        ],
        'https://cmc.byzart.eu/oembed/' => [
            'schemes' => [
                '|^https?://cmc\\.byzart\\.eu/files/.*$|i',
            ]
        ],
        'http://cacoo.com/oembed.json' => [
            'schemes' => [
                '|^https?://cacoo\\.com/diagrams/.*$|i',
            ]
        ],
        'https://www.catapult.app/_hcms/api/video/oembed' => [
            'schemes' => [
                '|^https?://www\\-catapult\\-app\\.sandbox\\.hs\\-sites\\.com/video\\-page.*$|i',
                '|^https?://www\\-catapult\\.app/video\\-page.*$|i',
            ]
        ],
        'http://img.catbo.at/oembed.json' => [
            'schemes' => [
                '|^https?://img\\.catbo\\.at/.*$|i',
            ]
        ],
        'http://view.ceros.com/oembed' => [
            'schemes' => [
                '|^https?://view\\.ceros\\.com/.*$|i',
            ]
        ],
        'https://www.chainflix.net/video/oembed' => [
            'schemes' => [
                '|^https?://chainflix\\.net/video/.*$|i',
                '|^https?://chainflix\\.net/video/embed/.*$|i',
                '|^https?://.*\\.chainflix\\.net/video/.*$|i',
                '|^https?://.*\\.chainflix\\.net/video/embed/.*$|i',
            ]
        ],
        'http://embed.chartblocks.com/1.0/oembed' => [
            'schemes' => [
                '|^https?://public\\.chartblocks\\.com/c/.*$|i',
            ]
        ],
        'http://chirb.it/oembed.json' => [
            'schemes' => [
                '|^https?://chirb\\.it/.*$|i',
            ]
        ],
        'https://chroco.ooo/embed' => [
            'schemes' => [
                '|^https?://chroco\\.ooo/mypage/.*$|i',
                '|^https?://chroco\\.ooo/story/.*$|i',
            ]
        ],
        'https://www.circuitlab.com/circuit/oembed/' => [
            'schemes' => [
                '|^https?://www\\.circuitlab\\.com/circuit/.*$|i',
            ]
        ],
        'https://www.clipland.com/api/oembed' => [
            'schemes' => [
                '|^https?://www\\.clipland\\.com/v/.*$|i',
                '|^https?://www\\.clipland\\.com/v/.*$|i',
            ]
        ],
        'http://api.clyp.it/oembed/' => [
            'schemes' => [
                '|^https?://clyp\\.it/.*$|i',
                '|^https?://clyp\\.it/playlist/.*$|i',
            ]
        ],
        'https://app.ilovecoco.video/api/oembed.json' => [
            'schemes' => [
                '|^https?://app\\.ilovecoco\\.video/.*/embed$|i',
            ]
        ],
        'https://codehs.com/api/sharedprogram/*/oembed/' => [
            'schemes' => [
                '|^https?://codehs\\.com/editor/share_abacus/.*$|i',
            ]
        ],
        'https://codepen.io/api/oembed' => [
            'schemes' => [
                '|^https?://codepen\\.io/.*$|i',
                '|^https?://codepen\\.io/.*$|i',
            ]
        ],
        'https://codepoints.net/api/v1/oembed' => [
            'schemes' => [
                '|^https?://codepoints\\.net/.*$|i',
                '|^https?://codepoints\\.net/.*$|i',
                '|^https?://www\\.codepoints\\.net/.*$|i',
                '|^https?://www\\.codepoints\\.net/.*$|i',
            ]
        ],
        'https://codesandbox.io/oembed' => [
            'schemes' => [
                '|^https?://codesandbox\\.io/s/.*$|i',
                '|^https?://codesandbox\\.io/embed/.*$|i',
            ]
        ],
        'http://www.collegehumor.com/oembed.json' => [
            'schemes' => [
                '|^https?://www\\.collegehumor\\.com/video/.*$|i',
            ]
        ],
        'https://commaful.com/api/oembed/' => [
            'schemes' => [
                '|^https?://commaful\\.com/play/.*$|i',
            ]
        ],
        'http://coub.com/api/oembed.json' => [
            'schemes' => [
                '|^https?://coub\\.com/view/.*$|i',
                '|^https?://coub\\.com/embed/.*$|i',
            ]
        ],
        'http://crowdranking.com/api/oembed.json' => [
            'schemes' => [
                '|^https?://crowdranking\\.com/.*/.*$|i',
            ]
        ],
        'https://crumb.sh/oembed/' => [
            'schemes' => [
                '|^https?://crumb\\.sh/.*$|i',
            ]
        ],
        'https://gql.cueup.io/oembed' => [
            'schemes' => [
                '|^https?://cueup\\.io/user/.*/sounds/.*$|i',
            ]
        ],
        'https://api.curated.co/oembed' => [
            'schemes' => [
                '|^https?://.*\\.curated\\.co/.*$|i',
            ]
        ],
        'https://app.customerdb.com/embed' => [
            'schemes' => [
                '|^https?://app\\.customerdb\\.com/share/.*$|i',
            ]
        ],
        'https://www.dailymotion.com/services/oembed' => [
            'schemes' => [
                '|^https?://www\\.dailymotion\\.com/video/.*$|i',
            ]
        ],
        'https://dalexni.com/oembed/' => [
            'schemes' => [
                '|^https?://dalexni\\.com/i/.*$|i',
            ]
        ],
        'https://api.datawrapper.de/v3/oembed/' => [
            'schemes' => [
                '|^https?://datawrapper\\.dwcdn\\.net/.*$|i',
            ]
        ],
        'https://embed.deseret.com/' => [
            'schemes' => [
                '|^https?://.*\\.deseret\\.com/.*$|i',
            ]
        ],
        'http://backend.deviantart.com/oembed' => [
            'schemes' => [
                '|^https?://.*\\.deviantart\\.com/art/.*$|i',
                '|^https?://.*\\.deviantart\\.com/.*\\#/d.*$|i',
                '|^https?://fav\\.me/.*$|i',
                '|^https?://sta\\.sh/.*$|i',
                '|^https?://.*\\.deviantart\\.com/art/.*$|i',
                '|^https?://.*\\.deviantart\\.com/.*/art/.*$|i',
                '|^https?://sta\\.sh/.*",$|i',
                '|^https?://.*\\.deviantart\\.com/.*\\#/d.*"$|i',
            ]
        ],
        'https://*.didacte.com/cards/oembed' => [
            'schemes' => [
                '|^https?://.*\\.didacte\\.com/a/course/.*$|i',
            ]
        ],
        'https://www.ultimedia.com/api/search/oembed' => [
            'schemes' => [
                '|^https?://www\\.ultimedia\\.com/central/video/edit/id/.*/topic_id/.*/$|i',
                '|^https?://www\\.ultimedia\\.com/default/index/videogeneric/id/.*/showtitle/1/viewnc/1$|i',
                '|^https?://www\\.ultimedia\\.com/default/index/videogeneric/id/.*$|i',
            ]
        ],
        'https://www.docdroid.net/api/oembed' => [
            'schemes' => [
                '|^https?://.*\\.docdroid\\.net/.*$|i',
                '|^https?://.*\\.docdroid\\.net/.*$|i',
                '|^https?://docdro\\.id/.*$|i',
                '|^https?://docdro\\.id/.*$|i',
                '|^https?://.*\\.docdroid\\.com/.*$|i',
                '|^https?://.*\\.docdroid\\.com/.*$|i',
            ]
        ],
        'http://dotsub.com/services/oembed' => [
            'schemes' => [
                '|^https?://dotsub\\.com/view/.*$|i',
            ]
        ],
        'https://api.d.tube/oembed' => [
            'schemes' => [
                '|^https?://d\\.tube/v/.*$|i',
            ]
        ],
        'http://egliseinfo.catholique.fr/api/oembed' => [
            'schemes' => [
                '|^https?://egliseinfo\\.catholique\\.fr/.*$|i',
            ]
        ],
        'https://embedery.com/api/oembed' => [
            'schemes' => [
                '|^https?://embedery\\.com/widget/.*$|i',
            ]
        ],
        'https://music.enystre.com/oembed' => [
            'schemes' => [
                '|^https?://music\\.enystre\\.com/lyrics/.*$|i',
            ]
        ],
        'https://ethfiddle.com/services/oembed/' => [
            'schemes' => [
                '|^https?://ethfiddle\\.com/.*$|i',
            ]
        ],
        'https://evt.live/api/oembed' => [
            'schemes' => [
                '|^https?://evt\\.live/.*$|i',
                '|^https?://evt\\.live/.*/.*$|i',
                '|^https?://live\\.eventlive\\.pro/.*$|i',
                '|^https?://live\\.eventlive\\.pro/.*/.*$|i',
            ]
        ],
        'https://oembed.ex.co/item' => [
            'schemes' => [
                '|^https?://app\\.ex\\.co/stories/.*$|i',
                '|^https?://www\\.playbuzz\\.com/.*$|i',
            ]
        ],
        'https://eyrie.io/v1/oembed' => [
            'schemes' => [
                '|^https?://eyrie\\.io/board/.*$|i',
                '|^https?://eyrie\\.io/sparkfun/.*$|i',
            ]
        ],
        'https://graph.facebook.com/v10.0/oembed_post' => [
            'schemes' => [
                '|^https?://www\\.facebook\\.com/.*/posts/.*$|i',
                '|^https?://www\\.facebook\\.com/.*/activity/.*$|i',
                '|^https?://www\\.facebook\\.com/.*/photos/.*$|i',
                '|^https?://www\\.facebook\\.com/photo\\.php\\?fbid\\=.*$|i',
                '|^https?://www\\.facebook\\.com/photos/.*$|i',
                '|^https?://www\\.facebook\\.com/permalink\\.php\\?story_fbid\\=.*$|i',
                '|^https?://www\\.facebook\\.com/media/set\\?set\\=.*$|i',
                '|^https?://www\\.facebook\\.com/questions/.*$|i',
                '|^https?://www\\.facebook\\.com/notes/.*/.*/.*$|i',
            ]
        ],
        'https://graph.facebook.com/v10.0/oembed_video' => [
            'schemes' => [
                '|^https?://www\\.facebook\\.com/.*/videos/.*$|i',
                '|^https?://www\\.facebook\\.com/video\\.php\\?id\\=.*$|i',
                '|^https?://www\\.facebook\\.com/video\\.php\\?v\\=.*$|i',
            ]
        ],
        'https://graph.facebook.com/v10.0/oembed_page' => [
            'schemes' => [
                '|^https?://www\\.facebook\\.com/.*$|i',
            ]
        ],
        'https://app.getfader.com/api/oembed' => [
            'schemes' => [
                '|^https?://app\\.getfader\\.com/projects/.*/publish$|i',
            ]
        ],
        'https://faithlifetv.com/api/oembed' => [
            'schemes' => [
                '|^https?://faithlifetv\\.com/items/.*$|i',
                '|^https?://faithlifetv\\.com/items/resource/.*/.*$|i',
                '|^https?://faithlifetv\\.com/media/.*$|i',
                '|^https?://faithlifetv\\.com/media/assets/.*$|i',
                '|^https?://faithlifetv\\.com/media/resource/.*/.*$|i',
            ]
        ],
        'https://www.fireworktv.com/oembed' => [
            'schemes' => [
                '|^https?://.*\\.fireworktv\\.com/.*$|i',
                '|^https?://.*\\.fireworktv\\.com/embed/.*/v/.*$|i',
            ]
        ],
        'https://www.fite.tv/oembed' => [
            'schemes' => [
                '|^https?://www\\.fite\\.tv/watch/.*$|i',
            ]
        ],
        'https://flat.io/services/oembed' => [
            'schemes' => [
                '|^https?://flat\\.io/score/.*$|i',
                '|^https?://.*\\.flat\\.io/score/.*$|i',
            ]
        ],
        'https://www.flickr.com/services/oembed/' => [
            'schemes' => [
                '|^https?://.*\\.flickr\\.com/photos/.*$|i',
                '|^https?://flic\\.kr/p/.*$|i',
                '|^https?://.*\\.flickr\\.com/photos/.*$|i',
                '|^https?://flic\\.kr/p/.*$|i',
                '|^https?://.*\\..*\\.flickr\\.com/.*/.*$|i',
                '|^https?://.*\\..*\\.flickr\\.com/.*/.*$|i',
            ]
        ],
        'https://app.flourish.studio/api/v1/oembed' => [
            'schemes' => [
                '|^https?://public\\.flourish\\.studio/visualisation/.*$|i',
                '|^https?://public\\.flourish\\.studio/story/.*$|i',
            ]
        ],
        'https://fiso.foxsports.com.au/oembed' => [
            'schemes' => [
                '|^https?://fiso\\.foxsports\\.com\\.au/isomorphic\\-widget/.*$|i',
                '|^https?://fiso\\.foxsports\\.com\\.au/isomorphic\\-widget/.*$|i',
            ]
        ],
        'https://framebuzz.com/oembed/' => [
            'schemes' => [
                '|^https?://framebuzz\\.com/v/.*$|i',
                '|^https?://framebuzz\\.com/v/.*$|i',
            ]
        ],
        'https://api.framer.com/web/oembed' => [
            'schemes' => [
                '|^https?://framer\\.com/share/.*$|i',
                '|^https?://framer\\.com/embed/.*$|i',
            ]
        ],
        'http://api.geograph.org.uk/api/oembed' => [
            'schemes' => [
                '|^https?://.*\\.geograph\\.org\\.uk/.*$|i',
                '|^https?://.*\\.geograph\\.co\\.uk/.*$|i',
                '|^https?://.*\\.geograph\\.ie/.*$|i',
                '|^https?://.*\\.wikimedia\\.org/.*_geograph\\.org\\.uk_.*$|i',
            ]
        ],
        'http://www.geograph.org.gg/api/oembed' => [
            'schemes' => [
                '|^https?://.*\\.geograph\\.org\\.gg/.*$|i',
                '|^https?://.*\\.geograph\\.org\\.je/.*$|i',
                '|^https?://channel\\-islands\\.geograph\\.org/.*$|i',
                '|^https?://channel\\-islands\\.geographs\\.org/.*$|i',
                '|^https?://.*\\.channel\\.geographs\\.org/.*$|i',
            ]
        ],
        'http://geo.hlipp.de/restapi.php/api/oembed' => [
            'schemes' => [
                '|^https?://geo\\-en\\.hlipp\\.de/.*$|i',
                '|^https?://geo\\.hlipp\\.de/.*$|i',
                '|^https?://germany\\.geograph\\.org/.*$|i',
            ]
        ],
        'http://embed.gettyimages.com/oembed' => [
            'schemes' => [
                '|^https?://gty\\.im/.*$|i',
            ]
        ],
        'https://api.gfycat.com/v1/oembed' => [
            'schemes' => [
                '|^https?://gfycat\\.com/.*$|i',
                '|^https?://www\\.gfycat\\.com/.*$|i',
                '|^https?://gfycat\\.com/.*$|i',
                '|^https?://www\\.gfycat\\.com/.*$|i',
            ]
        ],
        'https://www.gifnote.com/services/oembed' => [
            'schemes' => [
                '|^https?://www\\.gifnote\\.com/play/.*$|i',
            ]
        ],
        'https://giphy.com/services/oembed' => [
            'schemes' => [
                '|^https?://giphy\\.com/gifs/.*$|i',
                '|^https?://giphy\\.com/clips/.*$|i',
                '|^https?://gph\\.is/.*$|i',
                '|^https?://media\\.giphy\\.com/media/.*/giphy\\.gif$|i',
            ]
        ],
        'https://app.gong.io/oembed' => [
            'schemes' => [
                '|^https?://app\\.gong\\.io/call\\?id\\=.*$|i',
            ]
        ],
        'http://api.grain.co/_/api/oembed' => [
            'schemes' => [
                '|^https?://grain\\.co/highlight/.*$|i',
            ]
        ],
        'https://api.luminery.com/oembed' => [
            'schemes' => [
                '|^https?://gtchannel\\.com/watch/.*$|i',
            ]
        ],
        'https://api.gyazo.com/api/oembed' => [
            'schemes' => [
                '|^https?://gyazo\\.com/.*$|i',
            ]
        ],
        'https://hearthis.at/oembed/?format=json' => [
            'schemes' => [
                '|^https?://hearthis\\.at/.*/.*/$|i',
                '|^https?://hearthis\\.at/.*/set/.*/$|i',
            ]
        ],
        'https://player.hihaho.com/services/oembed' => [
            'schemes' => [
                '|^https?://player\\.hihaho\\.com/.*$|i',
            ]
        ],
        'https://www.hippovideo.io/services/oembed' => [
            'schemes' => [
                '|^https?://.*\\.hippovideo\\.io/.*$|i',
                '|^https?://.*\\.hippovideo\\.io/.*$|i',
            ]
        ],
        'https://homey.app/api/oembed/flow' => [
            'schemes' => [
                '|^https?://homey\\.app/f/.*$|i',
                '|^https?://homey\\.app/.*/flow/.*$|i',
            ]
        ],
        'http://huffduffer.com/oembed' => [
            'schemes' => [
                '|^https?://huffduffer\\.com/.*/.*$|i',
            ]
        ],
        'http://www.hulu.com/api/oembed.json' => [
            'schemes' => [
                '|^https?://www\\.hulu\\.com/watch/.*$|i',
            ]
        ],
        'https://oembed.idomoo.com/oembed' => [
            'schemes' => [
                '|^https?://.*\\.idomoo\\.com/.*$|i',
            ]
        ],
        'http://www.ifixit.com/Embed' => [
            'schemes' => [
                '|^https?://www\\.ifixit\\.com/Guide/View/.*$|i',
            ]
        ],
        'http://www.ifttt.com/oembed/' => [
            'schemes' => [
                '|^https?://ifttt\\.com/recipes/.*$|i',
            ]
        ],
        'https://www.iheart.com/oembed' => [
            'schemes' => [
                '|^https?://www\\.iheart\\.com/podcast/.*/.*$|i',
            ]
        ],
        'https://player.indacolive.com/services/oembed' => [
            'schemes' => [
                '|^https?://player\\.indacolive\\.com/player/jwp/clients/.*$|i',
            ]
        ],
        'https://infogram.com/oembed' => [
            'schemes' => [
                '|^https?://infogram\\.com/.*$|i',
            ]
        ],
        'https://infoveave.net/services/oembed/' => [
            'schemes' => [
                '|^https?://.*\\.infoveave\\.net/E/.*$|i',
                '|^https?://.*\\.infoveave\\.net/P/.*$|i',
            ]
        ],
        'https://www.injurymap.com/services/oembed' => [
            'schemes' => [
                '|^https?://www\\.injurymap\\.com/exercises/.*$|i',
            ]
        ],
        'https://www.inoreader.com/oembed/api/' => [
            'schemes' => [
                '|^https?://www\\.inoreader\\.com/oembed/$|i',
            ]
        ],
        'http://api.inphood.com/oembed' => [
            'schemes' => [
                '|^https?://.*\\.inphood\\.com/.*$|i',
            ]
        ],
        'https://graph.facebook.com/v10.0/instagram_oembed' => [
            'schemes' => [
                '|^https?://instagram\\.com/.*/p/.*,$|i',
                '|^https?://www\\.instagram\\.com/.*/p/.*,$|i',
                '|^https?://instagram\\.com/.*/p/.*,$|i',
                '|^https?://www\\.instagram\\.com/.*/p/.*,$|i',
                '|^https?://instagram\\.com/p/.*$|i',
                '|^https?://instagr\\.am/p/.*$|i',
                '|^https?://www\\.instagram\\.com/p/.*$|i',
                '|^https?://www\\.instagr\\.am/p/.*$|i',
                '|^https?://instagram\\.com/p/.*$|i',
                '|^https?://instagr\\.am/p/.*$|i',
                '|^https?://www\\.instagram\\.com/p/.*$|i',
                '|^https?://www\\.instagr\\.am/p/.*$|i',
                '|^https?://instagram\\.com/tv/.*$|i',
                '|^https?://instagr\\.am/tv/.*$|i',
                '|^https?://www\\.instagram\\.com/tv/.*$|i',
                '|^https?://www\\.instagr\\.am/tv/.*$|i',
                '|^https?://instagram\\.com/tv/.*$|i',
                '|^https?://instagr\\.am/tv/.*$|i',
                '|^https?://www\\.instagram\\.com/tv/.*$|i',
                '|^https?://www\\.instagr\\.am/tv/.*$|i',
                '|^https?://www\\.instagram\\.com/reel/.*$|i',
                '|^https?://www\\.instagram\\.com/reel/.*$|i',
                '|^https?://instagram\\.com/reel/.*$|i',
                '|^https?://instagram\\.com/reel/.*$|i',
                '|^https?://instagr\\.am/reel/.*$|i',
                '|^https?://instagr\\.am/reel/.*$|i',
            ]
        ],
        'https://www.insticator.com/oembed' => [
            'schemes' => [
                '|^https?://ppa\\.insticator\\.com/embed\\-unit/.*$|i',
            ]
        ],
        'https://issuu.com/oembed' => [
            'schemes' => [
                '|^https?://issuu\\.com/.*/docs/.*$|i',
            ]
        ],
        'https://api.jovian.ai/oembed.json' => [
            'schemes' => [
                '|^https?://jovian\\.ml/.*$|i',
                '|^https?://jovian\\.ml/viewer.*$|i',
                '|^https?://.*\\.jovian\\.ml/.*$|i',
                '|^https?://jovian\\.ai/.*$|i',
                '|^https?://jovian\\.ai/viewer.*$|i',
                '|^https?://.*\\.jovian\\.ai/.*$|i',
            ]
        ],
        'https://tv.kakao.com/oembed' => [
            'schemes' => [
                '|^https?://tv\\.kakao\\.com/channel/.*/cliplink/.*$|i',
                '|^https?://tv\\.kakao\\.com/m/channel/.*/cliplink/.*$|i',
                '|^https?://tv\\.kakao\\.com/channel/v/.*$|i',
                '|^https?://tv\\.kakao\\.com/channel/.*/livelink/.*$|i',
                '|^https?://tv\\.kakao\\.com/m/channel/.*/livelink/.*$|i',
                '|^https?://tv\\.kakao\\.com/channel/l/.*$|i',
            ]
        ],
        'http://www.kickstarter.com/services/oembed' => [
            'schemes' => [
                '|^https?://www\\.kickstarter\\.com/projects/.*$|i',
            ]
        ],
        'https://www.kidoju.com/api/oembed' => [
            'schemes' => [
                '|^https?://www\\.kidoju\\.com/en/x/.*/.*$|i',
                '|^https?://www\\.kidoju\\.com/fr/x/.*/.*$|i',
            ]
        ],
        'https://halaman.email/service/oembed' => [
            'schemes' => [
                '|^https?://halaman\\.email/form/.*$|i',
                '|^https?://aplikasi\\.kirim\\.email/form/.*$|i',
            ]
        ],
        'https://embed.kit.co/oembed' => [
            'schemes' => [
                '|^https?://kit\\.co/.*/.*$|i',
                '|^https?://kit\\.co/.*/.*$|i',
            ]
        ],
        'http://www.kitchenbowl.com/oembed' => [
            'schemes' => [
                '|^https?://www\\.kitchenbowl\\.com/recipe/.*$|i',
            ]
        ],
        'https://api.kmdr.sh/services/oembed' => [
            'schemes' => [
                '|^https?://app\\.kmdr\\.sh/h/.*$|i',
                '|^https?://app\\.kmdr\\.sh/history/.*$|i',
            ]
        ],
        'https://jdr.knacki.info/oembed' => [
            'schemes' => [
                '|^https?://jdr\\.knacki\\.info/meuh/.*$|i',
                '|^https?://jdr\\.knacki\\.info/meuh/.*$|i',
            ]
        ],
        'https://api.spoonacular.com/knowledge/oembed' => [
            'schemes' => [
                '|^https?://knowledgepad\\.co/\\#/knowledge/.*$|i',
            ]
        ],
        'https://embed-stage.kooapp.com/services/oembed' => [
            'schemes' => [
                '|^https?://.*\\.kooapp\\.com/koo/$|i',
                '|^https?://.*\\.kooapp\\.com/koo/$|i',
            ]
        ],
        'http://learningapps.org/oembed.php' => [
            'schemes' => [
                '|^https?://learningapps\\.org/.*$|i',
            ]
        ],
        'https://umotion-test.univ-lemans.fr/oembed' => [
            'schemes' => [
                '|^https?://umotion\\-test\\.univ\\-lemans\\.fr/video/.*$|i',
            ]
        ],
        'https://pod.univ-lille.fr/oembed' => [
            'schemes' => [
                '|^https?://pod\\.univ\\-lille\\.fr/video/.*$|i',
            ]
        ],
        'https://livestream.com/oembed' => [
            'schemes' => [
                '|^https?://livestream\\.com/accounts/.*/events/.*$|i',
                '|^https?://livestream\\.com/accounts/.*/events/.*/videos/.*$|i',
                '|^https?://livestream\\.com/.*/events/.*$|i',
                '|^https?://livestream\\.com/.*/events/.*/videos/.*$|i',
                '|^https?://livestream\\.com/.*/.*$|i',
                '|^https?://livestream\\.com/.*/.*/videos/.*$|i',
            ]
        ],
        'https://embed.lottiefiles.com/oembed' => [
            'schemes' => [
                '|^https?://lottiefiles\\.com/.*$|i',
                '|^https?://.*\\.lottiefiles\\.com/.*$|i',
            ]
        ],
        'https://app.ludus.one/oembed' => [
            'schemes' => [
                '|^https?://app\\.ludus\\.one/.*$|i',
            ]
        ],
        'https://admin.lumiere.is/api/services/oembed' => [
            'schemes' => [
                '|^https?://.*\\.lumiere\\.is/v/.*$|i',
            ]
        ],
        'http://mathembed.com/oembed' => [
            'schemes' => [
                '|^https?://mathembed\\.com/latex\\?inputText\\=.*$|i',
                '|^https?://mathembed\\.com/latex\\?inputText\\=.*$|i',
            ]
        ],
        'https://me.me/oembed' => [
            'schemes' => [
                '|^https?://me\\.me/i/.*$|i',
            ]
        ],
        'https://*.medialab.(co|app)/api/oembed/' => [
            'schemes' => [
                '|^https?://.*\\.medialab\\.app/share/watch/.*$|i',
                '|^https?://.*\\.medialab\\.co/share/watch/.*$|i',
                '|^https?://.*\\.medialab\\.app/share/social/.*$|i',
                '|^https?://.*\\.medialab\\.co/share/social/.*$|i',
                '|^https?://.*\\.medialab\\.app/share/embed/.*$|i',
                '|^https?://.*\\.medialab\\.co/share/embed/.*$|i',
            ]
        ],
        'https://medienarchiv.zhdk.ch/oembed.json' => [
            'schemes' => [
                '|^https?://medienarchiv\\.zhdk\\.ch/entries/.*$|i',
            ]
        ],
        'https://mermaid.ink/services/oembed' => [
            'schemes' => [
                '|^https?://mermaid\\.ink/img/.*$|i',
                '|^https?://mermaid\\.ink/svg/.*$|i',
            ]
        ],
        'https://web.microsoftstream.com/oembed' => [
            'schemes' => [
                '|^https?://.*\\.microsoftstream\\.com/video/.*$|i',
                '|^https?://.*\\.microsoftstream\\.com/channel/.*$|i',
            ]
        ],
        'https://oembed.minervaknows.com' => [
            'schemes' => [
                '|^https?://www\\.minervaknows\\.com/featured\\-recipes/.*$|i',
                '|^https?://www\\.minervaknows\\.com/themes/.*$|i',
                '|^https?://www\\.minervaknows\\.com/themes/.*/recipes/.*$|i',
                '|^https?://app\\.minervaknows\\.com/recipes/.*$|i',
                '|^https?://app\\.minervaknows\\.com/recipes/.*/follow$|i',
            ]
        ],
        'https://www.mixcloud.com/oembed/' => [
            'schemes' => [
                '|^https?://www\\.mixcloud\\.com/.*/.*/$|i',
                '|^https?://www\\.mixcloud\\.com/.*/.*/$|i',
            ]
        ],
        'http://api.mobypicture.com/oEmbed' => [
            'schemes' => [
                '|^https?://www\\.mobypicture\\.com/user/.*/view/.*$|i',
                '|^https?://moby\\.to/.*$|i',
            ]
        ],
        'https://musicboxmaniacs.com/embed/' => [
            'schemes' => [
                '|^https?://musicboxmaniacs\\.com/explore/melody/.*$|i',
            ]
        ],
        'https://mybeweeg.com/services/oembed' => [
            'schemes' => [
                '|^https?://mybeweeg\\.com/w/.*$|i',
            ]
        ],
        'https://namchey.com/api/oembed' => [
            'schemes' => [
                '|^https?://namchey\\.com/embeds/.*$|i',
            ]
        ],
        'https://www.nanoo.tv/services/oembed' => [
            'schemes' => [
                '|^https?://.*\\.nanoo\\.tv/link/.*$|i',
                '|^https?://nanoo\\.tv/link/.*$|i',
                '|^https?://.*\\.nanoo\\.pro/link/.*$|i',
                '|^https?://nanoo\\.pro/link/.*$|i',
                '|^https?://.*\\.nanoo\\.tv/link/.*$|i',
                '|^https?://nanoo\\.tv/link/.*$|i',
                '|^https?://.*\\.nanoo\\.pro/link/.*$|i',
                '|^https?://nanoo\\.pro/link/.*$|i',
                '|^https?://media\\.zhdk\\.ch/signatur/.*$|i',
                '|^https?://new\\.media\\.zhdk\\.ch/signatur/.*$|i',
                '|^https?://media\\.zhdk\\.ch/signatur/.*$|i',
                '|^https?://new\\.media\\.zhdk\\.ch/signatur/.*$|i',
            ]
        ],
        'https://api.nb.no/catalog/v1/oembed' => [
            'schemes' => [
                '|^https?://www\\.nb\\.no/items/.*$|i',
            ]
        ],
        'https://naturalatlas.com/oembed.json' => [
            'schemes' => [
                '|^https?://naturalatlas\\.com/.*$|i',
                '|^https?://naturalatlas\\.com/.*/.*$|i',
                '|^https?://naturalatlas\\.com/.*/.*/.*$|i',
                '|^https?://naturalatlas\\.com/.*/.*/.*/.*$|i',
            ]
        ],
        'http://www.nfb.ca/remote/services/oembed/' => [
            'schemes' => [
                '|^https?://.*\\.nfb\\.ca/film/.*$|i',
            ]
        ],
        'https://oembed.nopaste.ml' => [
            'schemes' => [
                '|^https?://nopaste\\.ml/.*$|i',
            ]
        ],
        'https://api.observablehq.com/oembed' => [
            'schemes' => [
                '|^https?://observablehq\\.com/@.*/.*$|i',
                '|^https?://observablehq\\.com/d/.*$|i',
                '|^https?://observablehq\\.com/embed/.*$|i',
            ]
        ],
        'https://www.odds.com.au/api/oembed/' => [
            'schemes' => [
                '|^https?://www\\.odds\\.com\\.au/.*$|i',
                '|^https?://odds\\.com\\.au/.*$|i',
            ]
        ],
        'https://song.link/oembed' => [
            'schemes' => [
                '|^https?://song\\.link/.*$|i',
                '|^https?://album\\.link/.*$|i',
                '|^https?://artist\\.link/.*$|i',
                '|^https?://playlist\\.link/.*$|i',
                '|^https?://pods\\.link/.*$|i',
                '|^https?://mylink\\.page/.*$|i',
                '|^https?://odesli\\.co/.*$|i',
            ]
        ],
        'https://odysee.com/$/oembed' => [
            'schemes' => [
                '|^https?://odysee\\.com/.*/.*$|i',
                '|^https?://odysee\\.com/.*$|i',
            ]
        ],
        'http://official.fm/services/oembed.json' => [
            'schemes' => [
                '|^https?://official\\.fm/tracks/.*$|i',
                '|^https?://official\\.fm/playlists/.*$|i',
            ]
        ],
        'https://omniscope.me/_global_/oembed/json' => [
            'schemes' => [
                '|^https?://omniscope\\.me/.*$|i',
            ]
        ],
        'https://omny.fm/oembed' => [
            'schemes' => [
                '|^https?://omny\\.fm/shows/.*$|i',
            ]
        ],
        'http://orbitvu.co/service/oembed' => [
            'schemes' => [
                '|^https?://orbitvu\\.co/001/.*/ov3601/view$|i',
                '|^https?://orbitvu\\.co/001/.*/ov3601/.*/view$|i',
                '|^https?://orbitvu\\.co/001/.*/ov3602/.*/view$|i',
                '|^https?://orbitvu\\.co/001/.*/2/orbittour/.*/view$|i',
                '|^https?://orbitvu\\.co/001/.*/1/2/orbittour/.*/view$|i',
                '|^https?://orbitvu\\.co/001/.*/ov3601/view$|i',
                '|^https?://orbitvu\\.co/001/.*/ov3601/.*/view$|i',
                '|^https?://orbitvu\\.co/001/.*/ov3602/.*/view$|i',
                '|^https?://orbitvu\\.co/001/.*/2/orbittour/.*/view$|i',
                '|^https?://orbitvu\\.co/001/.*/1/2/orbittour/.*/view$|i',
            ]
        ],
        'https://outplayed.tv/oembed' => [
            'schemes' => [
                '|^https?://outplayed\\.tv/media/.*$|i',
            ]
        ],
        'https://overflow.io/services/oembed' => [
            'schemes' => [
                '|^https?://overflow\\.io/s/.*$|i',
                '|^https?://overflow\\.io/embed/.*$|i',
            ]
        ],
        'https://core.oz.com/oembed' => [
            'schemes' => [
                '|^https?://www\\.oz\\.com/.*/video/.*$|i',
            ]
        ],
        'https://padlet.com/oembed/' => [
            'schemes' => [
                '|^https?://padlet\\.com/.*$|i',
            ]
        ],
        'https://www.pastery.net/oembed' => [
            'schemes' => [
                '|^https?://pastery\\.net/.*$|i',
                '|^https?://pastery\\.net/.*$|i',
                '|^https?://www\\.pastery\\.net/.*$|i',
                '|^https?://www\\.pastery\\.net/.*$|i',
            ]
        ],
        'https://tools.pinpoll.com/oembed' => [
            'schemes' => [
                '|^https?://tools\\.pinpoll\\.com/embed/.*$|i',
            ]
        ],
        'https://www.pinterest.com/oembed.json' => [
            'schemes' => [
                '|^https?://www\\.pinterest\\.com/.*$|i',
            ]
        ],
        'https://*.pitchhub.com.com/en/public/oembed' => [
            'schemes' => [
                '|^https?://.*\\.pitchhub\\.com/en/public/player/.*$|i',
            ]
        ],
        'https://store.pixdor.com/oembed' => [
            'schemes' => [
                '|^https?://store\\.pixdor\\.com/place\\-marker\\-widget/.*/show$|i',
                '|^https?://store\\.pixdor\\.com/map/.*/show$|i',
            ]
        ],
        'https://api.podbean.com/v1/oembed' => [
            'schemes' => [
                '|^https?://.*\\.podbean\\.com/e/.*$|i',
                '|^https?://.*\\.podbean\\.com/e/.*$|i',
            ]
        ],
        'http://polldaddy.com/oembed/' => [
            'schemes' => [
                '|^https?://.*\\.polldaddy\\.com/s/.*$|i',
                '|^https?://.*\\.polldaddy\\.com/poll/.*$|i',
                '|^https?://.*\\.polldaddy\\.com/ratings/.*$|i',
            ]
        ],
        'https://api.portfolium.com/oembed' => [
            'schemes' => [
                '|^https?://portfolium\\.com/entry/.*$|i',
            ]
        ],
        'https://gateway.cobalt.run/present/decks/oembed' => [
            'schemes' => [
                '|^https?://present\\.do/decks/.*$|i',
            ]
        ],
        'https://prezi.com/v/oembed' => [
            'schemes' => [
                '|^https?://prezi\\.com/v/.*$|i',
                '|^https?://.*\\.prezi\\.com/v/.*$|i',
            ]
        ],
        'http://www.quiz.biz/api/oembed' => [
            'schemes' => [
                '|^https?://www\\.quiz\\.biz/quizz\\-.*\\.html$|i',
            ]
        ],
        'http://www.quizz.biz/api/oembed' => [
            'schemes' => [
                '|^https?://www\\.quizz\\.biz/quizz\\-.*\\.html$|i',
            ]
        ],
        'https://oembed.radiopublic.com/oembed' => [
            'schemes' => [
                '|^https?://play\\.radiopublic\\.com/.*$|i',
                '|^https?://radiopublic\\.com/.*$|i',
                '|^https?://www\\.radiopublic\\.com/.*$|i',
                '|^https?://play\\.radiopublic\\.com/.*$|i',
                '|^https?://radiopublic\\.com/.*$|i',
                '|^https?://www\\.radiopublic\\.com/.*$|i',
                '|^https?://.*\\.radiopublic\\.com/.*$|i',
            ]
        ],
        'https://pub.raindrop.io/api/oembed' => [
            'schemes' => [
                '|^https?://raindrop\\.io/.*$|i',
                '|^https?://raindrop\\.io/.*/.*$|i',
                '|^https?://raindrop\\.io/.*/.*/.*$|i',
                '|^https?://raindrop\\.io/.*/.*/.*/.*$|i',
            ]
        ],
        'https://animatron.com/oembed' => [
            'schemes' => [
                '|^https?://www\\.rcvis\\.com/v/.*$|i',
                '|^https?://www\\.rcvis\\.com/visualize\\=.*$|i',
                '|^https?://www\\.rcvis\\.com/ve/.*$|i',
                '|^https?://www\\.rcvis\\.com/visualizeEmbedded\\=.*$|i',
            ]
        ],
        'https://www.reddit.com/oembed' => [
            'schemes' => [
                '|^https?://reddit\\.com/r/.*/comments/.*/.*$|i',
                '|^https?://www\\.reddit\\.com/r/.*/comments/.*/.*$|i',
            ]
        ],
        'http://publisher.releasewire.com/oembed/' => [
            'schemes' => [
                '|^https?://rwire\\.com/.*$|i',
            ]
        ],
        'https://replit.com/data/oembed' => [
            'schemes' => [
                '|^https?://repl\\.it/@.*/.*$|i',
                '|^https?://replit\\.com/@.*/.*$|i',
            ]
        ],
        'https://www.reverbnation.com/oembed' => [
            'schemes' => [
                '|^https?://www\\.reverbnation\\.com/.*$|i',
                '|^https?://www\\.reverbnation\\.com/.*/songs/.*$|i',
            ]
        ],
        'http://roomshare.jp/en/oembed.json' => [
            'schemes' => [
                '|^https?://roomshare\\.jp/post/.*$|i',
                '|^https?://roomshare\\.jp/en/post/.*$|i',
            ]
        ],
        'https://roosterteeth.com/oembed' => [
            'schemes' => [
                '|^https?://roosterteeth\\.com/.*$|i',
            ]
        ],
        'https://embed.runkit.com/oembed' => [
            'schemes' => [
                '|^https?://embed\\.runkit\\.com/.*,$|i',
                '|^https?://embed\\.runkit\\.com/.*,$|i',
            ]
        ],
        'https://octopus.saooti.com/oembed' => [
            'schemes' => [
                '|^https?://octopus\\.saooti\\.com/main/pub/podcast/.*$|i',
            ]
        ],
        'http://videos.sapo.pt/oembed' => [
            'schemes' => [
                '|^https?://videos\\.sapo\\.pt/.*$|i',
            ]
        ],
        'https://api.screen9.com/oembed' => [
            'schemes' => [
                '|^https?://console\\.screen9\\.com/.*$|i',
                '|^https?://.*\\.screen9\\.tv/.*$|i',
            ]
        ],
        'https://api.screencast.com/external/oembed' => [
            'schemes' => [
                '|^https?://www\\.screencast\\.com/.*$|i',
            ]
        ],
        'http://www.screenr.com/api/oembed.json' => [
            'schemes' => [
                '|^https?://www\\.screenr\\.com/.*/$|i',
            ]
        ],
        'https://scribblemaps.com/api/services/oembed.json' => [
            'schemes' => [
                '|^https?://www\\.scribblemaps\\.com/maps/view/.*$|i',
                '|^https?://www\\.scribblemaps\\.com/maps/view/.*$|i',
                '|^https?://scribblemaps\\.com/maps/view/.*$|i',
                '|^https?://scribblemaps\\.com/maps/view/.*$|i',
            ]
        ],
        'http://www.scribd.com/services/oembed/' => [
            'schemes' => [
                '|^https?://www\\.scribd\\.com/doc/.*$|i',
            ]
        ],
        'https://embed.sendtonews.com/services/oembed' => [
            'schemes' => [
                '|^https?://embed\\.sendtonews\\.com/oembed/.*$|i',
            ]
        ],
        'https://www.shortnote.jp/oembed/' => [
            'schemes' => [
                '|^https?://www\\.shortnote\\.jp/view/notes/.*$|i',
            ]
        ],
        'http://shoudio.com/api/oembed' => [
            'schemes' => [
                '|^https?://shoudio\\.com/.*$|i',
                '|^https?://shoud\\.io/.*$|i',
            ]
        ],
        'https://api.getshow.io/oembed.json' => [
            'schemes' => [
                '|^https?://app\\.getshow\\.io/iframe/.*$|i',
                '|^https?://.*\\.getshow\\.io/share/.*$|i',
            ]
        ],
        'https://showtheway.io/oembed' => [
            'schemes' => [
                '|^https?://showtheway\\.io/to/.*$|i',
            ]
        ],
        'https://simplecast.com/oembed' => [
            'schemes' => [
                '|^https?://simplecast\\.com/s/.*$|i',
            ]
        ],
        'https://onsizzle.com/oembed' => [
            'schemes' => [
                '|^https?://onsizzle\\.com/i/.*$|i',
            ]
        ],
        'http://sketchfab.com/oembed' => [
            'schemes' => [
                '|^https?://sketchfab\\.com/.*models/.*$|i',
                '|^https?://sketchfab\\.com/.*models/.*$|i',
                '|^https?://sketchfab\\.com/.*/folders/.*$|i',
            ]
        ],
        'https://www.slideshare.net/api/oembed/2' => [
            'schemes' => [
                '|^https?://www\\.slideshare\\.net/.*/.*$|i',
                '|^https?://www\\.slideshare\\.net/.*/.*$|i',
                '|^https?://fr\\.slideshare\\.net/.*/.*$|i',
                '|^https?://fr\\.slideshare\\.net/.*/.*$|i',
                '|^https?://de\\.slideshare\\.net/.*/.*$|i',
                '|^https?://de\\.slideshare\\.net/.*/.*$|i',
                '|^https?://es\\.slideshare\\.net/.*/.*$|i',
                '|^https?://es\\.slideshare\\.net/.*/.*$|i',
                '|^https?://pt\\.slideshare\\.net/.*/.*$|i',
                '|^https?://pt\\.slideshare\\.net/.*/.*$|i',
            ]
        ],
        'https://smashnotes.com/services/oembed' => [
            'schemes' => [
                '|^https?://smashnotes\\.com/p/.*$|i',
                '|^https?://smashnotes\\.com/p/.*/e/.* \\- https?://smashnotes\\.com/p/.*/e/.*/s/.*$|i',
            ]
        ],
        'https://www.smrthi.com/api/oembed' => [
            'schemes' => [
                '|^https?://www\\.smrthi\\.com/book/.*$|i',
            ]
        ],
        'https://api.smugmug.com/services/oembed/' => [
            'schemes' => [
                '|^https?://.*\\.smugmug\\.com/.*$|i',
                '|^https?://.*\\.smugmug\\.com/.*$|i',
            ]
        ],
        'https://www.socialexplorer.com/services/oembed/' => [
            'schemes' => [
                '|^https?://www\\.socialexplorer\\.com/.*/explore$|i',
                '|^https?://www\\.socialexplorer\\.com/.*/view$|i',
                '|^https?://www\\.socialexplorer\\.com/.*/edit$|i',
                '|^https?://www\\.socialexplorer\\.com/.*/embed$|i',
            ]
        ],
        'https://soundcloud.com/oembed' => [
            'schemes' => [
                '|^https?://soundcloud\\.com/.*$|i',
                '|^https?://soundcloud\\.com/.*$|i',
                '|^https?://soundcloud\\.app\\.goog\\.gl/.*$|i',
            ]
        ],
        'https://speakerdeck.com/oembed.json' => [
            'schemes' => [
                '|^https?://speakerdeck\\.com/.*/.*$|i',
                '|^https?://speakerdeck\\.com/.*/.*$|i',
            ]
        ],
        'https://open.spotify.com/oembed/' => [
            'schemes' => [
                '|^https?://open\\.spotify\\.com/.*$|i',
                '|^spotify:.*$|i',
            ]
        ],
        'https://api.spreaker.com/oembed' => [
            'schemes' => [
                '|^https?://.*\\.spreaker\\.com/.*$|i',
                '|^https?://.*\\.spreaker\\.com/.*$|i',
            ]
        ],
        'http://sproutvideo.com/oembed.json' => [
            'schemes' => [
                '|^https?://sproutvideo\\.com/videos/.*$|i',
                '|^https?://.*\\.vids\\.io/videos/.*$|i',
            ]
        ],
        'https://purl.stanford.edu/embed.json' => [
            'schemes' => [
                '|^https?://purl\\.stanford\\.edu/.*$|i',
            ]
        ],
        'https://api.streamable.com/oembed.json' => [
            'schemes' => [
                '|^https?://streamable\\.com/.*$|i',
                '|^https?://streamable\\.com/.*$|i',
            ]
        ],
        'https://streamio.com/api/v1/oembed' => [
            'schemes' => [
                '|^https?://s3m\\.io/.*$|i',
                '|^https?://23m\\.io/.*$|i',
            ]
        ],
        'https://subscribi.io/api/oembed' => [
            'schemes' => [
                '|^https?://subscribi\\.io/api/oembed.*$|i',
            ]
        ],
        'https://www.sudomemo.net/oembed' => [
            'schemes' => [
                '|^https?://www\\.sudomemo\\.net/watch/.*$|i',
                '|^https?://www\\.sudomemo\\.net/watch/.*$|i',
                '|^https?://flipnot\\.es/.*$|i',
                '|^https?://flipnot\\.es/.*$|i',
            ]
        ],
        'https://www.sutori.com/api/oembed' => [
            'schemes' => [
                '|^https?://www\\.sutori\\.com/story/.*$|i',
            ]
        ],
        'https://sway.com/api/v1.0/oembed' => [
            'schemes' => [
                '|^https?://sway\\.com/.*$|i',
                '|^https?://www\\.sway\\.com/.*$|i',
            ]
        ],
        'https://69jr5v75rc.execute-api.eu-west-1.amazonaws.com/prod/v2/oembed' => [
            'schemes' => [
                '|^https?://share\\.synthesia\\.io/.*$|i',
            ]
        ],
        'https://www.ted.com/services/v1/oembed.json' => [
            'schemes' => [
                '|^https?://ted\\.com/talks/.*$|i',
                '|^https?://ted\\.com/talks/.*$|i',
                '|^https?://www\\.ted\\.com/talks/.*$|i',
            ]
        ],
        'https://www.nytimes.com/svc/oembed/json/' => [
            'schemes' => [
                '|^https?://www\\.nytimes\\.com/svc/oembed$|i',
                '|^https?://nytimes\\.com/.*$|i',
                '|^https?://.*\\.nytimes\\.com/.*$|i',
            ]
        ],
        'https://theysaidso.com/extensions/oembed/' => [
            'schemes' => [
                '|^https?://theysaidso\\.com/image/.*$|i',
            ]
        ],
        'https://www.tickcounter.com/oembed' => [
            'schemes' => [
                '|^https?://www\\.tickcounter\\.com/countdown/.*$|i',
                '|^https?://www\\.tickcounter\\.com/countup/.*$|i',
                '|^https?://www\\.tickcounter\\.com/ticker/.*$|i',
                '|^https?://www\\.tickcounter\\.com/worldclock/.*$|i',
                '|^https?://www\\.tickcounter\\.com/countdown/.*$|i',
                '|^https?://www\\.tickcounter\\.com/countup/.*$|i',
                '|^https?://www\\.tickcounter\\.com/ticker/.*$|i',
                '|^https?://www\\.tickcounter\\.com/worldclock/.*$|i',
            ]
        ],
        'https://www.tiktok.com/oembed' => [
            'schemes' => [
                '|^https?://www\\.tiktok\\.com/.*/video/.*$|i',
            ]
        ],
        'https://widget.toornament.com/oembed' => [
            'schemes' => [
                '|^https?://www\\.toornament\\.com/tournaments/.*/information$|i',
                '|^https?://www\\.toornament\\.com/tournaments/.*/registration/$|i',
                '|^https?://www\\.toornament\\.com/tournaments/.*/matches/schedule$|i',
                '|^https?://www\\.toornament\\.com/tournaments/.*/stages/.*/$|i',
            ]
        ],
        'http://www.topy.se/oembed/' => [
            'schemes' => [
                '|^https?://www\\.topy\\.se/image/.*$|i',
            ]
        ],
        'https://app-test.totango.com/oembed' => [
            'schemes' => [
                '|^https?://app\\-test\\.totango\\.com/.*$|i',
            ]
        ],
        'https://trinitymedia.ai/player/trinity-oembed' => [
            'schemes' => [
                '|^https?://trinitymedia\\.ai/player/.*$|i',
                '|^https?://trinitymedia\\.ai/player/.*$|i',
            ]
        ],
        'https://www.tumblr.com/oembed/1.0' => [
            'schemes' => [
                '|^https?://.*\\.tumblr\\.com/post/.*$|i',
            ]
        ],
        'https://www.tuxx.be/services/oembed' => [
            'schemes' => [
                '|^https?://www\\.tuxx\\.be/.*$|i',
            ]
        ],
        'https://play.tvcf.co.kr/rest/oembed' => [
            'schemes' => [
                '|^https?://play\\.tvcf\\.co\\.kr/.*$|i',
                '|^https?://.*\\.tvcf\\.co\\.kr/.*$|i',
            ]
        ],
        'https://publish.twitter.com/oembed' => [
            'schemes' => [
                '|^https?://twitter\\.com/.*$|i',
                '|^https?://twitter\\.com/.*/status/.*$|i',
                '|^https?://.*\\.twitter\\.com/.*/status/.*$|i',
            ]
        ],
        'https://play.typecast.ai/oembed' => [
            'schemes' => [
                '|^https?://play\\.typecast\\.ai/s/.*$|i',
                '|^https?://play\\.typecast\\.ai/e/.*$|i',
                '|^https?://play\\.typecast\\.ai/.*$|i',
            ]
        ],
        'https://uapod.univ-antilles.fr/oembed' => [
            'schemes' => [
                '|^https?://uapod\\.univ\\-antilles\\.fr/video/.*$|i',
            ]
        ],
        'https://map.cam.ac.uk/oembed/' => [
            'schemes' => [
                '|^https?://map\\.cam\\.ac\\.uk/.*$|i',
            ]
        ],
        'https://mediatheque.univ-paris1.fr/oembed' => [
            'schemes' => [
                '|^https?://mediatheque\\.univ\\-paris1\\.fr/video/.*$|i',
            ]
        ],
        'https://pod.u-pec.fr/oembed' => [
            'schemes' => [
                '|^https?://pod\\.u\\-pec\\.fr/video/.*$|i',
            ]
        ],
        'http://www.ustream.tv/oembed' => [
            'schemes' => [
                '|^https?://.*\\.ustream\\.tv/.*$|i',
                '|^https?://.*\\.ustream\\.com/.*$|i',
            ]
        ],
        'https://app.ustudio.com/api/v2/oembed' => [
            'schemes' => [
                '|^https?://.*\\.ustudio\\.com/embed/.*$|i',
                '|^https?://.*\\.ustudio\\.com/embed/.*/.*$|i',
            ]
        ],
        'https://api.veer.tv/oembed' => [
            'schemes' => [
                '|^https?://veer\\.tv/videos/.*$|i',
            ]
        ],
        'https://api.veervr.tv/oembed' => [
            'schemes' => [
                '|^https?://veervr\\.tv/videos/.*$|i',
            ]
        ],
        'https://www.vevo.com/oembed' => [
            'schemes' => [
                '|^https?://www\\.vevo\\.com/.*$|i',
                '|^https?://www\\.vevo\\.com/.*$|i',
            ]
        ],
        'https://videfit.com/oembed' => [
            'schemes' => [
                '|^https?://videfit\\.com/videos/.*$|i',
            ]
        ],
        'https://api.vidyard.com/dashboard/v1.1/oembed' => [
            'schemes' => [
                '|^https?://.*\\.vidyard\\.com/.*$|i',
                '|^https?://.*\\.vidyard\\.com/.*$|i',
                '|^https?://.*\\.hubs\\.vidyard\\.com/.*$|i',
                '|^https?://.*\\.hubs\\.vidyard\\.com/.*$|i',
            ]
        ],
        'https://vimeo.com/api/oembed.json' => [
            'schemes' => [
                '|^https?://vimeo\\.com/.*$|i',
                '|^https?://vimeo\\.com/album/.*/video/.*$|i',
                '|^https?://vimeo\\.com/channels/.*/.*$|i',
                '|^https?://vimeo\\.com/groups/.*/videos/.*$|i',
                '|^https?://vimeo\\.com/ondemand/.*/.*$|i',
                '|^https?://player\\.vimeo\\.com/video/.*$|i',
            ]
        ],
        'https://www.viously.com/oembed' => [
            'schemes' => [
                '|^https?://www\\.viously\\.com/.*/.*$|i',
            ]
        ],
        'https://vizydrop.com/oembed' => [
            'schemes' => [
                '|^https?://vizydrop\\.com/shared/.*$|i',
            ]
        ],
        'https://vlipsy.com/oembed' => [
            'schemes' => [
                '|^https?://vlipsy\\.com/.*$|i',
            ]
        ],
        'https://www.vlive.tv/oembed' => [
            'schemes' => [
                '|^https?://www\\.vlive\\.tv/video/.*$|i',
            ]
        ],
        'https://data.voxsnap.com/oembed' => [
            'schemes' => [
                '|^https?://article\\.voxsnap\\.com/.*/.*$|i',
            ]
        ],
        'https://waltrack.net/oembed' => [
            'schemes' => [
                '|^https?://waltrack\\.net/product/.*$|i',
            ]
        ],
        'https://embed.wave.video/oembed' => [
            'schemes' => [
                '|^https?://watch\\.wave\\.video/.*$|i',
                '|^https?://embed\\.wave\\.video/.*$|i',
            ]
        ],
        'http://*.wiredrive.com/present-oembed/' => [
            'schemes' => [
                '|^https?://.*\\.wiredrive\\.com/.*$|i',
            ]
        ],
        'https://fast.wistia.com/oembed.json' => [
            'schemes' => [
                '|^https?://fast\\.wistia\\.com/embed/iframe/.*$|i',
                '|^https?://fast\\.wistia\\.com/embed/playlists/.*$|i',
                '|^https?://.*\\.wistia\\.com/medias/.*$|i',
            ]
        ],
        'https://app.wizer.me/api/oembed.json' => [
            'schemes' => [
                '|^https?://.*\\.wizer\\.me/learn/.*$|i',
                '|^https?://.*\\.wizer\\.me/preview/.*$|i',
            ]
        ],
        'https://wokwi.com/api/oembed' => [
            'schemes' => [
                '|^https?://wokwi\\.com/share/.*$|i',
            ]
        ],
        'https://www.wolframcloud.com/oembed' => [
            'schemes' => [
                '|^https?://.*\\.wolframcloud\\.com/.*$|i',
            ]
        ],
        'http://public-api.wordpress.com/oembed/' => [
            'schemes' => [
                '|^https?://wordpress\\.com/.*$|i',
                '|^https?://wordpress\\.com/.*$|i',
                '|^https?://.*\\.wordpress\\.com/.*$|i',
                '|^https?://.*\\.wordpress\\.com/.*$|i',
                '|^https?://.*\\..*\\.wordpress\\.com/.*$|i',
                '|^https?://.*\\..*\\.wordpress\\.com/.*$|i',
                '|^https?://wp\\.me/.*$|i',
                '|^https?://wp\\.me/.*$|i',
            ]
        ],
        'https://www.youtube.com/oembed' => [
            'schemes' => [
                '|^https?://.*\\.youtube\\.com/watch.*$|i',
                '|^https?://.*\\.youtube\\.com/v/.*$|i',
                '|^https?://youtu\\.be/.*$|i',
                '|^https?://.*\\.youtube\\.com/playlist\\?list\\=.*$|i',
                '|^https?://youtube\\.com/playlist\\?list\\=.*$|i',
            ]
        ],
        'https://app.zeplin.io/embed' => [
            'schemes' => [
                '|^https?://app\\.zeplin\\.io/project/.*/screen/.*$|i',
                '|^https?://app\\.zeplin\\.io/project/.*/screen/.*/version/.*$|i',
                '|^https?://app\\.zeplin\\.io/project/.*/styleguide/components\\?coid\\=.*$|i',
                '|^https?://app\\.zeplin\\.io/styleguide/.*/components\\?coid\\=.*$|i',
            ]
        ],
        'https://app.zingsoft.com/oembed' => [
            'schemes' => [
                '|^https?://app\\.zingsoft\\.com/embed/.*$|i',
                '|^https?://app\\.zingsoft\\.com/view/.*$|i',
            ]
        ],
        'https://api.znipe.tv/v3/oembed/' => [
            'schemes' => [
                '|^https?://.*\\.znipe\\.tv/.*$|i',
            ]
        ],
        'https://srv2.zoomable.ca/oembed' => [
            'schemes' => [
                '|^https?://srv2\\.zoomable\\.ca/viewer\\.php.*$|i',
            ]
        ],

        // Non OEmbed lister providers
        'http://jsbin.com/oembed' => [
            'schemes' => [
                '|^https?://output\\.jsbin\\.com/.*$|i',
                '|^https?://jsbin\\.com/.*$|i',
            ]
        ],
        'https://api.crowdsignal.com/oembed' => [
            'schemes' => [
                '|^https?://polldaddy\\.com/poll/.*$|i',
                '|^https?://poll\\.fm/.*$|i',
            ]
        ],
        'https://api.imgur.com/oembed' => [
            'schemes' => [
                '|^https?://imgur\\.com/.*$|i',
                '|^https?://i\\.imgur\\.com/.*$|i',
            ]
        ],
    ],

    /**
     *--------------------------------------------------------------------------
     * Regex Media Providers
     *--------------------------------------------------------------------------
     *
     * List of media providers used to construct embed elements.
     *
     */
    'regex_providers' => [
        'liveleak' => [
            'ssl' => true,
            'urls' => [
                '~^https?://(?:www\.)?liveleak\.com/ll_embed\?f=([0-9a-z]+)~imu',
                '~^https?://(?:www\.)?liveleak\.com/view\?t=([0-9a-z_]+)~imu'
            ],
            'data' => [
                'type' => 'video',
                'provider_name' => 'LiveLeak',
                'provider_url' => 'https://www.liveleak.com',
                'html' => [
                    'iframe' => [
                        'width' => 640,
                        'height' => 360,
                        'src' => '{protocol}://liveleak.com/e/{1}',
                    ],
                ],
            ],
        ],

        'ign' => [
            'ssl' => true,
            'urls' => [
                '~^https?://(?:www\.)?ign\.com/videos/([0-9a-zA-Z-_/]+)~imu'
            ],
            'data' => [
                'type' => 'video',
                'provider_name' => 'IGN',
                'provider_url' => 'https://ign.com',
                'html' => [
                    'iframe' => [
                        'width' => 560,
                        'height' => 315,
                        'src' => '{protocol}://widgets.ign.com/video/embed/content.html?url={1}',
                    ],
                ],
            ],
        ],

        'vine' => [
            'ssl' => true,
            'urls' => [
                '~^https?://(?:www\.)?vine\.co/v/([0-9a-zA-Z]+)~imu',
            ],
            'data' => [
                'type' => 'video',
                'provider_name' => 'Vine',
                'provider_url' => 'https://vine.co',
                'html' => [
                    'iframe' => [
                        'width' => 600,
                    'height' => 600,
                        'src' => '{protocol}://vine.co/v/{1}/embed/postcard',
                    ],
                ],
            ],
        ],

        'twitch' => [
            'ssl' => true,
            'urls' => [
                '~^https?://(?:www\.)?twitch\.tv/([0-9a-zA-Z-_]+)$~imu'
            ],
            'data' => [
                'type' => 'video',
                'provider_name' => 'Twitch',
                'provider_url' => 'https://twitch.tv/{1}',
                'html' => [
                    'iframe' => [
                        'width'  => 500,
                        'height' => 350,
                        'src' => '{protocol}://player.twitch.tv/?channel={1}&parent=',
                        'allowfullscreen' => null,
                        'frameborder' => 0,
                        'sandbox' => 'allow-scripts allow-popups allow-same-origin allow-presentation',
                        'layout' => 'responsive'
                    ]
                ],
            ],
        ],

        'twitchVideo' => [
            'ssl' => true,
            'urls' => [
                '~^https?://(?:www\.)?twitch\.tv/videos/(\d+)$~imu'
            ],
            'data' => [
                'type' => 'video',
                'provider_name' => 'Twitch Videos',
                'provider_url' => 'https://twitch.tv/videos/{1}',
                'html' => [
                    'iframe' => [
                        'width' => 600,
                        'height' => 365,
                        'src' => '{protocol}://player.twitch.tv/?video=v{1}&autoplay=false&parent=www.example.com',
                        'allowfullscreen' => null,
                        'frameborder' => 0,
                        'sandbox' => 'allow-scripts allow-popups allow-same-origin allow-presentation',
                        'layout' => 'responsive'
                    ]
                ],
            ],
        ],

        'twitchClip' => [
            'ssl' => true,
            'urls' => [
                '~^https?://clips.twitch\.tv/([a-zA-Z0-9-_]+)$~imu',
                '~^https?://(?:www\.)?twitch\.tv/(?:[0-9a-zA-Z-_]+)/clip/([0-9a-zA-Z-_]+)~imu',
            ],
            'data' => [
                'type' => 'video',
                'provider_name' => 'Twitch Clip',
                'provider_url' => '{protocol}://clips.twitch.tv/{1}',
                'html' => [
                    'iframe' => [
                        'width'  => 420,
                        'height' => 237,
                        'src' => '{protocol}://clips.twitch.tv/embed?clip={1}&autoplay=false&tt_medium=clips_embed&parent=www.example.com',
                        'scrolling' => 'no',
                        'allowfullscreen' => true,
                        'frameborder'     => 0,
                        'sandbox' => 'allow-scripts allow-popups allow-same-origin allow-presentation',
                        'layout' => 'responsive'
                    ]
                ],
            ],
        ],

        'html5video' => [
            'ssl' => false,
            'urls' => [
                '~^https?://(.*).(mp4|ogg|webm)$~imu',
            ],
            'data' => [
                'type' => 'video',
                'provider_name' => 'HTML5 Video',
                'provider_url' => '{protocol}://{1}.{2}',
                'html' => [
                    'video' => [
                        'width' => 600,
                        'height' => 339,
                        'source' => [
                            [
                                'src' => '{protocol}://{1}.webm',
                                'type' => 'video/webm',
                            ],
                            [
                                'src' => '{protocol}://{1}.ogg',
                                'type' => 'video/ogg',
                            ],
                            [
                                'src' => '{protocol}://{1}.mp4',
                                'type' => 'video/mp4',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
