<?php
declare(strict_types=1);
/**
 * File of the Money test file
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * PHP version 7.0
 *
 * @category   Masthowasli
 * @package    ValueObject
 * @subpackage Test
 * @author     Thomas Sliwa <ts@unfinished.dyndns.org>
 * @copyright  2015 - Thomas Sliwa
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */

namespace Masthowasli\ValueObject\Test\Financial;

use Masthowasli\ValueObject\Financial\Currency\Usd;
use Masthowasli\ValueObject\Financial\Money;
use Masthowasli\ValueObject\Financial\Currency\Eur;
use Masthowasli\ValueObject\Test\Mock\ComparableMock;
use Masthowasli\ValueObject\Test\Mock\EquatableMock;

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
        $this->money = new Money(500, new Eur());
    }

    public function testExceptionOnNegativeMoneyValue()
    {
        $this->expectException('\Masthowasli\ValueObject\Financial\Exception\MoneyException');
        $this->expectExceptionCode(10);
        $this->expectExceptionMessage('A monetary value must be positive [0 given]');

        new Money(0, new Eur());
    }

    public function testEqualsReturnsTrue()
    {
        static::assertTrue($this->money->equals(new Money(500, new Eur())));
    }

    public function testEqualsReturnsFalseForNonMoneyArgument()
    {
        static::assertFalse($this->money->equals(new EquatableMock()));
    }

    public function testEqualsReturnsFalseForDifferentCurrencies()
    {
        static::assertFalse($this->money->equals(new Money(500, new Usd())));
    }

    public function testEqualsReturnsFalseForDifferentValues()
    {
        static::assertFalse($this->money->equals(new Money(100, new Eur())));
    }

    public function testCompareThrowsNonMoneyException()
    {
        $this->expectException('\Masthowasli\ValueObject\Financial\Exception\MoneyException');
        $this->expectExceptionCode(15);
        $this->expectExceptionMessage('Non monetary value [Masthowasli\ValueObject\Test\Mock\ComparableMock given]');

        $this->money->compareTo(new ComparableMock());
    }

    public function testCompareToReturnsNegativeForLargerArgumentValue()
    {
        static::assertLessThan(0, $this->money->compareTo(new Money(1000, new Eur())));
    }

    public function testCompareToReturnsPositiveForSmallerArgumentValue()
    {
        static::assertGreaterThan(0, $this->money->compareTo(new Money(100, new Eur())));
    }

    public function testCompareToReturnsZeroForEqualArgumentValue()
    {
        static::assertEquals(0, $this->money->compareTo(new Money(500, new Eur())));
    }

    public function testAddSuccess()
    {
        static::assertEquals(new Money(1000, new Eur()), $this->money->add($this->money));
    }

    public function testAddThrowsDifferingCurrenciesException()
    {
        $this->expectException('\Masthowasli\ValueObject\Financial\Exception\MoneyException');
        $this->expectExceptionCode(20);
        $this->expectExceptionMessage('Cannot process monetary values with different currencies [EUR and USD given]');

        $this->money->add(new Money(500, new Usd()));
    }

    public function testSubtractSuccess()
    {
        $moneyPlusOne = $this->money->add(new Money(1, new Eur()));

        static::assertEquals(new Money(1, new Eur()), $moneyPlusOne->subtract($this->money));
    }

    public function testSubtractThrowsDifferingCurrenciesException()
    {

        $this->expectException('\Masthowasli\ValueObject\Financial\Exception\MoneyException');
        $this->expectExceptionCode(20);
        $this->expectExceptionMessage('Cannot process monetary values with different currencies [EUR and USD given]');

        $this->money->subtract(new Money(500, new USD()));
    }

    public function testMultiplyThrowsNonPositiveFactorExceptionForNegativeValue()
    {
        $this->expectException('\Masthowasli\ValueObject\Financial\Exception\MoneyException');
        $this->expectExceptionCode(30);
        $this->expectExceptionMessage('Cannot multiply a monetary value with a non positive factor [-1 given]');

        $this->money->multiply(-1);
    }

    public function testMultiplyThrowsNonPositiveFactorExceptionForZero()
    {
        $this->expectException('\Masthowasli\ValueObject\Financial\Exception\MoneyException');
        $this->expectExceptionCode(30);
        $this->expectExceptionMessage('Cannot multiply a monetary value with a non positive factor [0 given]');

        $this->money->multiply(0);
    }

    public function testMultiplySuccess()
    {
        $tenEuro = new Money(100, new Eur());
        static::assertEquals(new Money(2500, new Eur()), $this->money->multiply(5));
        static::assertEquals(new Money(2500, new Eur()), $this->money->multiply(5.0));
        static::assertEquals(new Money(1250, new Eur()), $this->money->multiply(2.5));
        static::assertEquals(new Money(99, new Eur()), $tenEuro->multiply(0.99));
        static::assertEquals(new Money(99, new Eur()), $tenEuro->multiply(0.99999999));
    }

    public function testSplitThrowsZeroValueExceptionLeft()
    {
        $this->expectException('\Masthowasli\ValueObject\Financial\Exception\MoneyException');
        $this->expectExceptionCode(40);
        $this->expectExceptionMessage('Splitting the value by a proportion of 0:1 results in a zero money value');

        $this->money->split(0, 1);
    }

    public function testSplitThrowsZeroValueExceptionRight()
    {
        $this->expectException('\Masthowasli\ValueObject\Financial\Exception\MoneyException');
        $this->expectExceptionCode(40);
        $this->expectExceptionMessage('Splitting the value by a proportion of 1:0 results in a zero money value');

        $this->money->split(1, 0);
    }

    public function testSplit()
    {
        $splitFrom = new Money(5, new Eur());

        static::assertEquals([new Money(1, new Eur()), new Money(4, new Eur())], $splitFrom->split(1, 4));
        static::assertEquals([new Money(2, new Eur()), new Money(3, new Eur())], $splitFrom->split(2, 3));
        static::assertEquals([new Money(3, new Eur()), new Money(2, new Eur())], $splitFrom->split(3, 2));
        static::assertEquals([new Money(4, new Eur()), new Money(1, new Eur())], $splitFrom->split(4, 1));
        static::assertEquals([new Money(3, new Eur()), new Money(2, new Eur())], $splitFrom->split(1, 1));
    }
}
