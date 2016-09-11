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

/**
 * This is the dummy test class.
 *
 * @author {{ author }}
 */
class QwerteeTest extends AbstractTestCase
{
    public function testIsReleaseTimeIsTrue()
    {
        // set time to 23'o
        Carbon::setTestNow(
            Carbon::create(2016, 9, 10, 23, 0, 0)
        );

        $this->assertTrue(Qwertee::isReleaseTime());
    }
}
