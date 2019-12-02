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

        $this->assertEquals('A World of Dreams and Adventures', $items['title']);
        $this->assertEquals('https://cdn.qwertee.com/images/designs/zoom/105195.jpg', $items['zoom']);
        $this->assertEquals('https://cdn.qwertee.com/images/designs/mens/105195.jpg', $items['mens']);
        $this->assertEquals('https://cdn.qwertee.com/images/designs/womens/105195.jpg', $items['womens']);
        $this->assertEquals('https://cdn.qwertee.com/images/designs/kids/105195.jpg', $items['kids']);
        $this->assertEquals('https://cdn.qwertee.com/images/designs/hoodie/105195.jpg', $items['hoodie']);
        $this->assertEquals('https://cdn.qwertee.com/images/designs/sweater/105195.jpg', $items['sweater']);
        $this->assertEquals('2016-09-10', $items['releasedAt']);
    }
}
