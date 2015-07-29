<?php
/**
 * File of the Eur test file
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * PHP version 5.3
 *
 * @category   Masthowasli
 * @package    ValueObject
 * @subpackage Test
 * @author     Thomas Sliwa <ts@unfinished.dyndns.org>
 * @copyright  2015 - Thomas Sliwa
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */

namespace Masthowasli\ValueObject\Test\Monetary\Currency;

use Masthowasli\ValueObject\Monetary\Currency;
use Masthowasli\ValueObject\Monetary\Currency\Eur;

/**
 * Tests the Eur currency value object
 *
 * @category   Masthowasli
 * @package    ValueObject
 * @subpackage Test
 * @author     Thomas Sliwa <ts@unfinished.dyndns.org>
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */
class EurTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Currency
     */
    private $currency;

    protected function setup()
    {
        $this->currency = new Eur();
    }

    public function testEqualsReturnsTrue()
    {
        $other = new Eur();

        $this->assertTrue($this->currency->equals($other));
    }

    public function testEqualsReturnsFalse()
    {
        $this->markTestSkipped('later');
    }
}
