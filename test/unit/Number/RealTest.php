<?php
/**
 * File of the Real test file
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

namespace Masthowasli\ValueObject\Test\Number;

use Masthowasli\ValueObject\Number\Real;

/**
 * Tests the Integer value object
 *
 * @category   Masthowasli
 * @package    ValueObject
 * @subpackage Test
 * @author     Thomas Sliwa <ts@unfinished.dyndns.org>
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */
class RealTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Masthowasli\ValueObject\Number\Real
     */
    private $real;

    /**
     * @{inheritdoc}
     */
    protected function setup()
    {
        $this->real = new Real(2.0);
    }

    public function testValidConstruction()
    {
        static::assertInstanceOf(
            'Masthowasli\ValueObject\Number\Real',
            $this->real
        );

        new Real(1);
    }

    public function testConstructionFailsWithString()
    {
        static::setExpectedException('\InvalidArgumentException');

        new Real('1');
    }

    public function testConstructionFailsWithBoolean()
    {
        static::setExpectedException('\InvalidArgumentException');

        new Real(true);
    }

    public function testEqualsReturnsTrue()
    {
        static::assertTrue($this->real->equals(new Real(2.0)));
    }

    public function testEqualsReturnsFalseForNonMoneyArgument()
    {
        /** @var \Masthowasli\ValueObject\Number\Number $mock */
        $mock = static::getMock('Masthowasli\ValueObject\Number\Number');

        static::assertFalse($this->real->equals($mock));
    }

    public function testEqualsReturnsFalseForDifferentValues()
    {
        static::assertFalse($this->real->equals(new Real(1)));
    }

    public function testCompareToReturnsNegativeForLargerArgumentValue()
    {
        static::assertLessThan(0, $this->real->compareTo(new Real(2.00000001)));
    }

    public function testCompareToReturnsPositiveForSmallerArgumentValue()
    {
        static::assertGreaterThan(0, $this->real->compareTo(new Real(1.99999999)));
    }

    public function testCompareToReturnsZeroForEqualArgumentValue()
    {
        static::assertEquals(0, $this->real->compareTo(new Real(2)));
    }

    public function testCompareToThrowsAnExceptionForNonRealComparableInstance()
    {
        /** @var \Masthowasli\ValueObject\Comparable $mock */
        $mock = static::getMock('Masthowasli\ValueObject\Comparable');

        static::setExpectedException('\InvalidArgumentException');
        $this->real->compareTo($mock);
    }

    public function testAddition()
    {
        static::assertEquals(new Real(3.5), $this->real->add(new Real(1.5)));
    }

    public function testAdditionThrowsExceptionForNonRealArgument()
    {
        /** @var \Masthowasli\ValueObject\Number\Operation\Addition $mock */
        $mock = static::getMock('Masthowasli\ValueObject\Number\Operation\Addition');

        static::setExpectedException('\InvalidArgumentException');
        $this->real->add($mock);
    }

    public function testSubtraction()
    {
        static::assertEquals(new Real(0.1), $this->real->subtract(new Real(1.9)));
    }

    public function testSubtractionThrowsExceptionForNonIntegerArgument()
    {
        /** @var \Masthowasli\ValueObject\Number\Operation\Subtraction $mock */
        $mock = static::getMock('Masthowasli\ValueObject\Number\Operation\Subtraction');

        static::setExpectedException('\InvalidArgumentException');
        $this->real->subtract($mock);
    }

    public function testMultiplication()
    {
        static::assertEquals(new Real(5), $this->real->multiply(new Real(2.5)));
    }

    public function testMultiplicationThrowsExceptionForNonIntegerArgument()
    {
        /** @var \Masthowasli\ValueObject\Number\Operation\Multiplication $mock */
        $mock = static::getMock('Masthowasli\ValueObject\Number\Operation\Multiplication');

        static::setExpectedException('\InvalidArgumentException');
        $this->real->multiply($mock);
    }

    public function testDivision()
    {
        $ten = new Real(10);
        static::assertEquals(new Real(2), $ten->divide(new Real(5)));
        static::assertEquals(new Real(3.3333333333333335), $ten->divide(new Real(3)));
    }

    public function testDivisionThrowsExceptionWhenDivisorIsZero()
    {
        $this->setExpectedException('\Masthowasli\ValueObject\Number\Exception\DivisionByZero');

        $this->real->divide(new Real(0));
    }
}
