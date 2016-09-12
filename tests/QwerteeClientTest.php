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
namespace Okaufmann\Tests\Qwertee;

use Okaufmann\Qwertee\QwerteeClient;

class QwerteeClientTest extends AbstractTestCase
{
    /**
     * @var QwerteeClient
     */
    private static $client;

    protected function setUp()
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

        /*
        "title" => "A World of Dreams and Adventures"
        "zoom" => "https://cdn.qwertee.com/images/designs/zoom/105195.jpg"
        "mens" => "https://cdn.qwertee.com/images/designs/mens/105195.jpg"
        "womens" => "https://cdn.qwertee.com/images/designs/womens/105195.jpg"
        "kids" => "https://cdn.qwertee.com/images/designs/kids/105195.jpg"
        "hoodie" => "https://cdn.qwertee.com/images/designs/hoodie/105195.jpg"
        "sweater" => "https://cdn.qwertee.com/images/designs/sweater/105195.jpg"
        */

        $this->assertArrayHasKey('title', $items);
        $this->assertArrayHasKey('zoom', $items);
        $this->assertArrayHasKey('mens', $items);
        $this->assertArrayHasKey('womens', $items);
        $this->assertArrayHasKey('kids', $items);
        $this->assertArrayHasKey('hoodie', $items);
        $this->assertArrayHasKey('sweater', $items);

        $this->assertTrue($items['title'] == 'A World of Dreams and Adventures');
        $this->assertTrue($items['zoom'] == 'https://cdn.qwertee.com/images/designs/zoom/105195.jpg');
        $this->assertTrue($items['mens'] == 'https://cdn.qwertee.com/images/designs/mens/105195.jpg');
        $this->assertTrue($items['womens'] == 'https://cdn.qwertee.com/images/designs/womens/105195.jpg');
        $this->assertTrue($items['kids'] == 'https://cdn.qwertee.com/images/designs/kids/105195.jpg');
        $this->assertTrue($items['hoodie'] == 'https://cdn.qwertee.com/images/designs/hoodie/105195.jpg');
        $this->assertTrue($items['sweater'] == 'https://cdn.qwertee.com/images/designs/sweater/105195.jpg');
    }
}
