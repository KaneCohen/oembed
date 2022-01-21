<?php
namespace Cohensive\OEmbed;

use \Exception;

class ImportProviders
{
    public function generateProviders()
    {
        $response = file_get_contents('https://oembed.com/providers.json');

        if (!$response) {
            throw new Exception('Error reteriving providers list.');
        }

        $providers = json_decode($response, true);

        $providerFormat = <<<END
        [
            'provider_name' => '%s',
            'provider_url' => '%s',
            'endpoints' => [
                %s
            ]
        ],

        END;

        $endpointFormat = <<<END
        [
                    'schemes' => [
                %s
                    ],
                    'url' => '%s',
                ],
        END;

        $schemeFormat = <<<END
                '%s',
        END;

        $formattedProviders = '';
        foreach ($providers as $provider) {
            $endpoints = '';
            foreach ($provider['endpoints'] as $ekey => $endpoint) {
                if (!isset($endpoint['schemes'])) {
                    continue;
                }

                $schemes = '';
                $url = str_replace('.{format}', '.json', $endpoint['url']);
                $url = str_replace('?format={format}', '?format=json', $url);
                foreach ($endpoint['schemes'] as $skey => $url) {
                    $scheme = '|^' . $url;
                    $scheme = preg_replace('/([.=?#-])/i', '\\\\\\\\${1}', $scheme);
                    $scheme = str_replace('http:', 'https?:', $scheme);
                    $scheme = str_replace('https:', 'https?:', $scheme);
                    $scheme = str_replace('*', '.*', $scheme);
                    $scheme .= '$|i';
                    $schemes .= ($skey > 0 ? "\n        " : "") . sprintf($schemeFormat, $scheme);
                }
                $endpoints .= ($ekey > 0 ? "\n        " : "") . sprintf($endpointFormat, $schemes, $endpoint['url']);
            }

            $formattedProviders .= sprintf(
                $providerFormat,
                $provider['provider_name'],
                $provider['provider_url'],
                $endpoints
            );
        }

        file_put_contents('providers.txt', $formattedProviders);
    }

    public function generateSimpleProviders()
    {
        $response = file_get_contents('https://oembed.com/providers.json');

        if (!$response) {
            throw new Exception('Error reteriving providers list.');
        }

        $providers = json_decode($response, true);

        $providerFormat = <<<END
        '%s' => [
            'schemes' => [
                %s
            ]
        ],

        END;

        $schemeFormat = <<<END
        '%s',
        END;

        $formattedProviders = '';
        foreach ($providers as $provider) {
            foreach ($provider['endpoints'] as $endpoint) {
                if (!isset($endpoint['schemes'])) {
                    continue;
                }

                $schemes = '';
                $url = str_replace('.{format}', '.json', $endpoint['url']);
                $url = str_replace('?format={format}', '?format=json', $url);
                foreach ($endpoint['schemes'] as $skey => $url) {
                    $scheme = '|^' . $url;
                    $scheme = preg_replace('/([.=?#-])/i', '\\\\\\\\${1}', $scheme);
                    $scheme = str_replace('http:', 'https?:', $scheme);
                    $scheme = str_replace('https:', 'https?:', $scheme);
                    $scheme = str_replace('*', '.*', $scheme);
                    $scheme .= '$|i';
                    $schemes .= ($skey > 0 ? "\n        " : "") . sprintf($schemeFormat, $scheme);
                }

                $formattedProviders .= sprintf(
                    $providerFormat,
                    $endpoint['url'],
                    $schemes
                );
            }
        }

        file_put_contents('simple_providers.txt', $formattedProviders);
    }
}

(new ImportProviders)->generateProviders();
(new ImportProviders)->generateSimpleProviders();
