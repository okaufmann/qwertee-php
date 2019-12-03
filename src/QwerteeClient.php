<?php
/**
 * QwerteeClient.php, qwertee-php.
 *
 * This File belongs to to Project qwertee-php
 *
 * @author Oliver Kaufmann <okaufmann91@gmail.com>
 *
 * @version 1.0
 */

namespace Okaufmann\QwerteePhp;

use Illuminate\Support\Collection;
use Symfony\Component\DomCrawler\Crawler;

class QwerteeClient
{
    /**
     * @var \SimplePie
     */
    private $client;

    /**
     * @var string
     */
    private $feedUrl;

    public function __construct()
    {
        $this->feedUrl = 'https://www.qwertee.com/rss';
    }

    /**
     * Returns the actual feed items ordered by newest to oldest.
     *
     * @return \Illuminate\Support\Collection
     */
    public function feedItems()
    {
        if ($this->client == null) {
            $this->initializeFeed();
        }

        $list = collect($this->client->get_items())
            ->sortBy(function (\SimplePie_Item $item, $key) {
                return $item->get_title();
            })->sortByDesc(function (\SimplePie_Item $item, $key) {
                return $item->get_date('Ymd');
            });

        $list = $this->extractData($list);

        return $list;
    }

    /**
     * Setup SimplePie.
     *
     * @param null $data Set feed data otherwise the official qwertee feed url will be used.
     */
    public function initializeFeed($data = null)
    {
        $this->client = new \SimplePie();

        if ($data != null) {
            $this->client->set_raw_data($data);
        } else {
            $this->client->set_feed_url($this->feedUrl);
        }

        $this->client->enable_cache(false);
        $this->client->init();
    }

    private function extractData(Collection $feedItems)
    {
        $dataItems = $feedItems->map(function (\SimplePie_Item $item) {
            $crawler = new Crawler($item->get_content());
            $mens = $crawler->filter('img')->first()->attr('src');

            $keys = collect(['title', 'zoom', 'mens', 'womens', 'kids', 'hoodie', 'sweater', 'releasedAt']);

            $title = $item->get_title();
            $zoom = str_replace('mens', 'zoom', $mens);
            $womens = str_replace('mens', 'womens', $mens);
            $kids = str_replace('mens', 'kids', $mens);
            $hoodie = str_replace('mens', 'hoodie', $mens);
            $sweater = str_replace('mens', 'sweater', $mens);
            $releasedAt = $item->get_date('Y-m-d');

            return $keys->combine([$title, $zoom, $mens, $womens, $kids, $hoodie, $sweater, $releasedAt]);
        });

        return $dataItems;
    }
}
