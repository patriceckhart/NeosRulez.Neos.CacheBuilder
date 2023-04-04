<?php
namespace NeosRulez\Neos\CacheBuilder\Service;

/*
 * This file is part of the NeosRulez.Neos.CacheBuilder package.
 */

use Neos\Flow\Annotations as Flow;
use GuzzleHttp\Client;

class CacheService
{

    #[Flow\InjectConfiguration(package: 'NeosRulez.Neos.CacheBuilder', path: 'sitemaps')]
    protected array $sitemaps;

    /**
     * @return bool
     */
    public function buildCache(): bool
    {
        if(count($this->sitemaps) === 0) {
            return false;
        } else {
            foreach ($this->sitemaps as $sitemap) {
                $this->callPageUrls($this->getSitemapFromUrl($sitemap));
            }
        }
        return true;
    }

    /**
     * @param string $sitemap
     * @return void
     */
    public function buildCacheOnce(string $sitemap): void
    {
        $this->callPageUrls($this->getSitemapFromUrl($sitemap));
    }

    /**
     * @param string $url
     * @return array
     */
    private function getSitemapFromUrl(string $url): array
    {
        $xml = simplexml_load_file($url);
        $json = json_encode($xml);
        $array = json_decode($json,true);
        return array_key_exists('url', $array) ? $array['url'] : [];
    }

    /**
     * @param array $urls
     * @return void
     */
    private function callPageUrls(array $urls): void
    {
        $client = new Client();
        foreach ($urls as $url) {
            $request = $client->request('GET', $url['loc']);
            if($request->getStatusCode() === 200) {
                echo "👍 " . $url['loc'] . "\n";
            } else {
                echo "⛔️ The URL returns an error (" . $request->getStatusCode() . "): " . $url['loc'] . "\n";
            }
        }
    }

}
