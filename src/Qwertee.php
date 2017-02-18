<?php
/**
 * Qwertee.php, qwertee-php.
 *
 * This File belongs to to Project qwertee-php
 *
 * @author Oliver Kaufmann <okaufmann91@gmail.com>
 *
 * @version 1.0
 */

namespace Okaufmann\Qwertee;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class Qwertee
{
    /**
     * @var QwerteeClient
     */
    private static $client = null;

    /**
     * Get Todays qwertee tees.
     *
     * @return Collection
     */
    public static function today()
    {
        return self::getFirstThreeItems();
    }

    /**
     * Get last chance tees.
     *
     * @return Collection
     */
    public static function lastChance()
    {
        return self::getNextThreeItems();
    }

    /**
     * @return Collection
     */
    public static function getFirstThreeItems()
    {
        return self::getClient()->feedItems()->take(3)->values();
    }

    /**
     * @return Collection
     */
    public static function getNextThreeItems()
    {
        return self::getClient()->feedItems()->slice(3)->take(3)->values();
    }

    private static function getHour()
    {
        return Carbon::now()->hour;
    }

    /**
     * @return bool
     */
    public static function isReleaseTime()
    {
        // if it is between 23h and 11h return 3
        $hour = self::getHour();

        return $hour >= 23 || $hour < 11;
    }

    /**
     * @return bool
     */
    public static function isLastChanceTime()
    {
        // if it is between 11h and 23h (but not 23h!)
        $hour = self::getHour();

        return $hour >= 11 && $hour < 23;
    }

    /**
     * @param null $client
     */
    public static function setClient($client)
    {
        self::$client = $client;
    }

    /**
     * @return QwerteeClient
     */
    public static function getClient()
    {
        if (self::$client == null) {
            $qClient = new QwerteeClient();
            $qClient->initializeFeed();
            self::setClient($qClient);
        }

        return self::$client;
    }
}
