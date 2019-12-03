<?php
/*
 * This file is part of Package.
 *
 * (c) {{ author }}
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Okaufmann\QwerteePhp\Tests;

use Carbon\Carbon;
use Okaufmann\QwerteePhp\Qwertee;
use Okaufmann\QwerteePhp\QwerteeClient;
use PHPUnit\Framework\TestCase;

class QwerteeTest extends TestCase
{
    protected function setUp(): void
    {
        $client = new QwerteeClient();
        $client->initializeFeed(file_get_contents(__DIR__.'/data/rss.xml'));
        Qwertee::setClient($client);
    }

    public function testIsReleaseTimeIsTrue()
    {
        Carbon::setTestNow(
            Carbon::create(2019, 12, 2, 23, 0, 0)
        );

        $this->assertTrue(Qwertee::isReleaseTime());

        Carbon::setTestNow(
            Carbon::create(2019, 12, 2, 11, 0, 0)
        );

        $this->assertFalse(Qwertee::isReleaseTime());
    }

    public function testIsLastChanceTimeIsTrue()
    {
        Carbon::setTestNow(
            Carbon::create(2019, 12, 2, 11, 0, 0)
        );

        $this->assertTrue(Qwertee::isLastChanceTime());

        Carbon::setTestNow(
            Carbon::create(2019, 12, 2, 23, 0, 0)
        );

        $this->assertFalse(Qwertee::isLastChanceTime());
    }

    public function testGetCorrectFirstThree()
    {
        $firstThree = Qwertee::getFirstThreeItems();

        $this->assertCount(3, $firstThree);

        $this->assertEquals('liquid space', $firstThree[0]['title']);
        $this->assertEquals('space avatar', $firstThree[1]['title']);
        $this->assertEquals('space rocks', $firstThree[2]['title']);
    }

    public function testGetCorrectNextThree()
    {
        $nextThree = Qwertee::getNextThreeItems();

        $this->assertCount(3, $nextThree);

        $this->assertEquals('Cyber Monday InsaniTEE Sale!', $nextThree[0]['title']);
        $this->assertEquals('Warrior of Love', $nextThree[1]['title']);
        $this->assertEquals('Worthy Goose', $nextThree[2]['title']);
    }

    public function testGetTodaysTeesAtReleaseTime()
    {
        Carbon::setTestNow(
            Carbon::create(2019, 12, 2, 23, 0, 0)
        );

        $tees = Qwertee::today();

        $this->assertCount(3, $tees);

        $this->assertEquals('liquid space', $tees[0]['title']);
        $this->assertEquals('space avatar', $tees[1]['title']);
        $this->assertEquals('space rocks', $tees[2]['title']);
    }

    public function testGetTodaysTeesAtLastChanceTime()
    {
        Carbon::setTestNow(
            Carbon::create(2019, 12, 2, 11, 0, 0)
        );

        $tees = Qwertee::today();

        $this->assertCount(3, $tees);

        $this->assertEquals('liquid space', $tees[0]['title']);
        $this->assertEquals('space avatar', $tees[1]['title']);
        $this->assertEquals('space rocks', $tees[2]['title']);
    }

    public function testGetLastChanceTeesAtReleaseTime()
    {
        Carbon::setTestNow(
            Carbon::create(2019, 12, 2, 23, 0, 0)
        );

        $tees = Qwertee::lastChance();

        $this->assertCount(3, $tees);

        $this->assertEquals('Cyber Monday InsaniTEE Sale!', $tees[0]['title']);
        $this->assertEquals('Warrior of Love', $tees[1]['title']);
        $this->assertEquals('Worthy Goose', $tees[2]['title']);
    }

    public function testGetLastChanceTeesAtLastChanceTime()
    {
        Carbon::setTestNow(
            Carbon::create(2019, 12, 2, 11, 0, 0)
        );

        $tees = Qwertee::lastChance();

        $this->assertCount(3, $tees);

        $this->assertEquals('Cyber Monday InsaniTEE Sale!', $tees[0]['title']);
        $this->assertEquals('Warrior of Love', $tees[1]['title']);
        $this->assertEquals('Worthy Goose', $tees[2]['title']);
    }
}
