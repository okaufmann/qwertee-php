<?php
/**
 * QwerteeClientTest.php, qwertee-php.
 *
 * This File belongs to to Project qwertee-php
 *
 * @author Oliver Kaufmann <okaufmann91@gmail.com>
 *
 * @version 1.0
 */

namespace Okaufmann\QwerteePhp\Tests;

use Okaufmann\QwerteePhp\QwerteeClient;
use PHPUnit\Framework\TestCase;

class QwerteeClientTest extends TestCase
{
    /**
     * @var QwerteeClient
     */
    private static $client;

    protected function setUp(): void
    {
        self::$client = new QwerteeClient();
        self::$client->initializeFeed(file_get_contents(__DIR__.'/data/rss.xml'));
    }

    public function testGetFeedItems()
    {
        $items = self::$client->feedItems();
        $this->assertCount(6, $items);
    }

    public function testCorrectFeedListFormat()
    {
        $items = self::$client->feedItems()->first();

        $this->assertArrayHasKey('title', $items);
        $this->assertArrayHasKey('zoom', $items);
        $this->assertArrayHasKey('mens', $items);
        $this->assertArrayHasKey('womens', $items);
        $this->assertArrayHasKey('kids', $items);
        $this->assertArrayHasKey('hoodie', $items);
        $this->assertArrayHasKey('sweater', $items);
        $this->assertArrayHasKey('releasedAt', $items);

        $this->assertEquals('liquid space', $items['title']);
        $this->assertEquals('https://cdn.qwertee.com/images/designs/product-thumbs/1574940810-155719-zoom-500x600.jpg', $items['zoom']);
        $this->assertEquals('https://cdn.qwertee.com/images/designs/product-thumbs/1574940810-155719-mens-500x600.jpg', $items['mens']);
        $this->assertEquals('https://cdn.qwertee.com/images/designs/product-thumbs/1574940810-155719-womens-500x600.jpg', $items['womens']);
        $this->assertEquals('https://cdn.qwertee.com/images/designs/product-thumbs/1574940810-155719-kids-500x600.jpg', $items['kids']);
        $this->assertEquals('https://cdn.qwertee.com/images/designs/product-thumbs/1574940810-155719-hoodie-500x600.jpg', $items['hoodie']);
        $this->assertEquals('https://cdn.qwertee.com/images/designs/product-thumbs/1574940810-155719-sweater-500x600.jpg', $items['sweater']);
        $this->assertEquals('2019-12-02', $items['releasedAt']);
    }
}
