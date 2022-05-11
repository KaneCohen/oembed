[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/KaneCohen/oembed/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/KaneCohen/oembed/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/KaneCohen/oembed/badges/build.png?b=master)](https://scrutinizer-ci.com/g/KaneCohen/oembed/build-status/master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/KaneCohen/oembed/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)

# OEmbed

PHP library to retreive and display embed media from various media providers that support OEmbed data format. Websites such as YouTube, Vimeo, Twitter, Imgur and others.

This library also comes with support for direct mp4/video sources and some of the media providers that don't use OEmbed.

## Installation

Library is written in PHP 8 with various neat features it gives, so apologies to everybody who wanted to use it in previous versions of PHP. If you do need similar library, I could recommend checking my previous package in this field: [cohensive/embed](https://github.com/KaneCohen/embed).

Add following require to your `composer.json` file:

~~~
"cohensive/oembed": "dev-master"
// or
"cohensive/oembed": "^0.16"
~~~

Then run `composer install` or `composer update` to download it and autoload.

Or run:

~~~
$ composer require cohensive/oembed
~~~

If you're installing this library and want to utilize it with Laravel, package should automatically load its Service Provider.

If you plan to use OEmbed facade with Laravel, add Facade to your app.php config file in aliases section:

~~~
'aliases' => array(

	//...
	'OEmbed' => 'Cohensive\OEmbed\Facades\OEmbed'
	//...

)
~~~

## Usage

Standalone use:
~~~
// Use of factory will automatically load list of providers.
$factory = new \Cohensive\OEmbed\Factory();
$embed = $factory->get('http://youtu.be/uifYHNyH-jA');

if ($embed) {
	// Print default embed html code.
	echo $embed->html();

	// Print embed html code with custom width. Works for IFRAME and VIDEO html embed code.
	echo $embed->html(['width' => 600]);

	// Checks if embed data contains details on thumbnail.
	$embed->hasThumbnail();

	// Returns embed "src" - URL string / array of strings / null for current embed.
	// Accepts same options as "html" method.
	$embed->src();

	// Returns an array containing thumbnail details: url, width and height.
	$embed->thumbnail();

	// Returns an array containing all available embed data including default HTML code.
	$embed->data();
}
~~~

Laravel use:
~~~
// Either use Facade:
$embed = OEmbed::get('http://youtu.be/uifYHNyH-jA');

// Load via Dependency Injection:
public function method(OEmbed $oembed) {
	$embed = OEmbed::get('http://youtu.be/uifYHNyH-jA');
}

if ($embed) {
	// Print default embed html code.
	echo $embed->html();

	// Print embed html code with custom width. Works for IFRAME and VIDEO html embed code.
	echo $embed->html(['width' => 600]);

	// Checks if embed data contains details on thumbnail.
	$embed->hasThumbnail();

	// Returns an array containing thumbnail details: url, width and height.
	$embed->thumbnail();

	// Return thumbnail url if it exists or null.
	$embed->thumbnailUrl();

	// Returns an array containing all available embed data including default HTML code.
	$embed->data();
}
~~~

## Config

Library comes with a big config file located in `resources/` folder. That file contains an array where you can specify few things on a global basis and will you to pick which media providers you want to be used and which not.

Config file will be automatically loaded if you're using library with Laravel, which you can also publish and edit:

~~~
$ php artisan vendor:publish
~~~

If you're using OEmbed in standalone mode, you can add your own config file into Factory or OEmbed classes.

### Important Changes

Config format changed to use `snake_case` array keys instead of previously used `camelCase`.
