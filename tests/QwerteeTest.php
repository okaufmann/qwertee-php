<?php
/*
 * This file is part of Package.
 *
 * (c) {{ author }}
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Okaufmann\Tests\Qwertee;

use Carbon\Carbon;
use Okaufmann\Qwertee\Qwertee;
use Okaufmann\Qwertee\QwerteeClient;

class QwerteeTest extends AbstractTestCase
{
    protected function setUp()
    {
        $client = new QwerteeClient();
        $client->initializeFeed(file_get_contents(__DIR__.'/data/rss.xml'));
        Qwertee::setClient($client);
    }

    public function testIsReleaseTimeIsTrue()
    {
        Carbon::setTestNow(
            Carbon::create(2016, 9, 10, 23, 0, 0)
        );

        $this->assertTrue(Qwertee::isReleaseTime());

        Carbon::setTestNow(
            Carbon::create(2016, 9, 10, 11, 0, 0)
        );

        $this->assertFalse(Qwertee::isReleaseTime());
    }

    public function testIsLastChanceTimeIsTrue()
    {
        Carbon::setTestNow(
            Carbon::create(2016, 9, 10, 11, 0, 0)
        );

        $this->assertTrue(Qwertee::isLastChanceTime());

        Carbon::setTestNow(
            Carbon::create(2016, 9, 10, 23, 0, 0)
        );

        $this->assertFalse(Qwertee::isLastChanceTime());
    }

    public function testGetCorrectFirstThree()
    {
        $firstThree = Qwertee::getFirstThreeItems();

        $this->assertCount(3, $firstThree);

        $this->assertEquals('A World of Dreams and Adventures', $firstThree[0]['title']);
        $this->assertEquals('Save The Ocean', $firstThree[1]['title']);
        $this->assertEquals('The Forest Protectress', $firstThree[2]['title']);
    }

    public function testGetCorrectNextThree()
    {
        $nextThree = Qwertee::getNextThreeItems();

        $this->assertCount(3, $nextThree);

        $this->assertEquals('Chaos and Disobey', $nextThree[0]['title']);
        $this->assertEquals('TOXIC FACE', $nextThree[1]['title']);
        $this->assertEquals('We are Groot', $nextThree[2]['title']);
    }

    public function testGetTodaysTeesAtReleaseTime()
    {
        Carbon::setTestNow(
            Carbon::create(2016, 9, 10, 23, 0, 0)
        );

        $tees = Qwertee::today();

        $this->assertCount(3, $tees);

        $this->assertEquals('A World of Dreams and Adventures', $tees[0]['title']);
        $this->assertEquals('Save The Ocean', $tees[1]['title']);
        $this->assertEquals('The Forest Protectress', $tees[2]['title']);
    }

    public function testGetTodaysTeesAtLastChanceTime()
    {
        Carbon::setTestNow(
            Carbon::create(2016, 9, 10, 11, 0, 0)
        );

        $tees = Qwertee::today();

        $this->assertCount(3, $tees);

        $this->assertEquals('A World of Dreams and Adventures', $tees[0]['title']);
        $this->assertEquals('Save The Ocean', $tees[1]['title']);
        $this->assertEquals('The Forest Protectress', $tees[2]['title']);
    }

    public function testGetLastChanceTeesAtReleaseTime()
    {
        Carbon::setTestNow(
            Carbon::create(2016, 9, 10, 23, 0, 0)
        );

        $tees = Qwertee::lastChance();

        $this->assertCount(3, $tees);

        $this->assertEquals('Chaos and Disobey', $tees[0]['title']);
        $this->assertEquals('TOXIC FACE', $tees[1]['title']);
        $this->assertEquals('We are Groot', $tees[2]['title']);
    }

    public function testGetLastChanceTeesAtLastChanceTime()
    {
        Carbon::setTestNow(
            Carbon::create(2016, 9, 10, 11, 0, 0)
        );

        $tees = Qwertee::lastChance();

        $this->assertCount(3, $tees);

        $this->assertEquals('Chaos and Disobey', $tees[0]['title']);
        $this->assertEquals('TOXIC FACE', $tees[1]['title']);
        $this->assertEquals('We are Groot', $tees[2]['title']);
    }
}
