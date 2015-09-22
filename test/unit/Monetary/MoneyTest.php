<?php
/**
 * File of the Money test file
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

namespace Masthowasli\ValueObject\Test\Monetary;

use Masthowasli\ValueObject\Monetary\Money;
use Masthowasli\ValueObject\Monetary\Currency;
use Masthowasli\ValueObject\Monetary\Currency\Eur;
use Masthowasli\ValueObject\Number\Integer;

/**
 * Tests the Money value object
 *
 * @category   Masthowasli
 * @package    ValueObject
 * @subpackage Test
 * @author     Thomas Sliwa <ts@unfinished.dyndns.org>
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */
class MoneyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Money
     */
    private $money;

    /**
     * @{inheritDoc}
     */
    protected function setup()
    {
        $this->money = new Money(new Integer(500), new Eur());
    }

    public function testEqualsReturnsTrue()
    {
        static::assertTrue($this->money->equals(new Money(new Integer(500), new Eur())));
    }

    public function testEqualsReturnsFalseForNonMoneyArgument()
    {
        /** @var \Masthowasli\ValueObject\Equatable $mock */
        $mock = static::getMock('Masthowasli\ValueObject\Equatable');

        static::assertFalse($this->money->equals($mock));
    }

    public function testEqualsReturnsFalseForDifferentCurrencies()
    {
        /** @var \Masthowasli\ValueObject\Monetary\Currency $mock */
        $mock = static::getMock('Masthowasli\ValueObject\Monetary\Currency');

        static::assertFalse($this->money->equals(new Money(new Integer(500), $mock)));
    }

    public function testEqualsReturnsFalseForDifferentValues()
    {
        static::assertFalse($this->money->equals(new Money(new Integer(100), new Eur())));
    }

    public function testCompareToReturnsNegativeForLargerArgumentValue()
    {
        static::assertLessThan(0, $this->money->compareTo(new Money(new Integer(1000), new Eur())));
    }

    public function testCompareToReturnsPositiveForSmallerArgumentValue()
    {
        static::assertGreaterThan(0, $this->money->compareTo(new Money(new Integer(100), new Eur())));
    }

    public function testCompareToReturnsZeroForEqualArgumentValue()
    {
        static::assertEquals(0, $this->money->compareTo(new Money(new Integer(500), new Eur())));
    }

    public function testCompareToThrowsAnExceptionForNonMoneyComparableInstance()
    {
        /** @var \Masthowasli\ValueObject\Comparable $mock */
        $mock = static::getMock('Masthowasli\ValueObject\Comparable');

        static::setExpectedException('\InvalidArgumentException');
        static::assertEquals(0, $this->money->compareTo($mock));
    }

    public function testAddSuccess()
    {
        static::assertEquals(new Money(new Integer(1000), new Eur()), $this->money->add($this->money));
    }

    public function testAddThrowsAnInvalidArgumentExceptionForDifferentCurrencies()
    {
        /** @var \Masthowasli\ValueObject\Monetary\Currency $mock */
        $mock = static::getMock('Masthowasli\ValueObject\Monetary\Currency');

        static::setExpectedException('\InvalidArgumentException');
        $this->money->add(new Money(new Integer(500), $mock));
    }

    public function testSubtractSuccess()
    {
        static::assertEquals(new Money(new Integer(0), new Eur()), $this->money->subtract($this->money));
    }

    public function testSubtractThrowsAnInvalidArgumentExceptionForDifferentCurrencies()
    {
        /** @var \Masthowasli\ValueObject\Monetary\Currency $mock */
        $mock = static::getMock('Masthowasli\ValueObject\Monetary\Currency');

        static::setExpectedException('\InvalidArgumentException');
        $this->money->subtract(new Money(new Integer(500), $mock));
    }
}
