<?php
/**
 * File of the Integer test file
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

use Masthowasli\ValueObject\Number\Integer;

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
class IntegerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Masthowasli\ValueObject\Number\Integer
     */
    private $integer;

    /**
     * @{inheritdoc}
     */
    protected function setup()
    {
        $this->integer = new Integer(1);
    }

    public function testValidConstruction()
    {
        static::assertInstanceOf(
            'Masthowasli\ValueObject\Number\Integer',
            $this->integer
        );
    }

    public function testConstructionFailsWithFloat()
    {
        static::setExpectedException('\InvalidArgumentException');

        new Integer(1.0);
    }

    public function testConstructionFailsWithString()
    {
        static::setExpectedException('\InvalidArgumentException');

        new Integer('1');
    }

    public function testConstructionFailsWithBoolean()
    {
        static::setExpectedException('\InvalidArgumentException');

        new Integer(true);
    }

    public function testToString()
    {
        static::assertEquals('1', $this->integer);
    }

    public function testEqualsReturnsTrue()
    {
        static::assertTrue($this->integer->equals(new Integer(1)));
    }

    public function testEqualsReturnsFalseForNonIntegerArgument()
    {
        /** @var \Masthowasli\ValueObject\Number\Number $mock */
        $mock = static::getMock('Masthowasli\ValueObject\Number\Number');

        static::assertFalse($this->integer->equals($mock));
    }

    public function testEqualsReturnsFalseForDifferentValues()
    {
        static::assertFalse($this->integer->equals(new Integer(2)));
    }

    public function testCompareToReturnsNegativeForLargerArgumentValue()
    {
        static::assertLessThan(0, $this->integer->compareTo(new Integer(2)));
    }

    public function testCompareToReturnsPositiveForSmallerArgumentValue()
    {
        static::assertGreaterThan(0, $this->integer->compareTo(new Integer(0)));
    }

    public function testCompareToReturnsZeroForEqualArgumentValue()
    {
        static::assertEquals(0, $this->integer->compareTo(new Integer(1)));
    }

    public function testCompareToThrowsAnExceptionForNonIntegerComparableInstance()
    {
        /** @var \Masthowasli\ValueObject\Comparable $mock */
        $mock = static::getMock('Masthowasli\ValueObject\Comparable');

        static::setExpectedException('\InvalidArgumentException');
        static::assertEquals(0, $this->integer->compareTo($mock));
    }

    public function testAddition()
    {
        static::assertEquals(new Integer(2), $this->integer->add(new Integer(1)));
    }

    public function testAdditionThrowsExceptionForNonIntegerArgument()
    {
        /** @var \Masthowasli\ValueObject\Number\Operation\Addition $mock */
        $mock = static::getMock('Masthowasli\ValueObject\Number\Operation\Addition');

        static::setExpectedException('\InvalidArgumentException');
        static::assertEquals(new Integer(2), $this->integer->add($mock));
    }

    public function testSubtraction()
    {
        static::assertEquals(new Integer(0), $this->integer->subtract(new Integer(1)));
    }

    public function testSubtractionThrowsExceptionForNonIntegerArgument()
    {
        /** @var \Masthowasli\ValueObject\Number\Operation\Subtraction $mock */
        $mock = static::getMock('Masthowasli\ValueObject\Number\Operation\Subtraction');

        static::setExpectedException('\InvalidArgumentException');
        static::assertEquals(new Integer(2), $this->integer->subtract($mock));
    }

    public function testMultiplication()
    {
        static::assertEquals(new Integer(5), $this->integer->multiply(new Integer(5)));
    }

    public function testMultiplicationThrowsExceptionForNonIntegerArgument()
    {
        /** @var \Masthowasli\ValueObject\Number\Operation\Multiplication $mock */
        $mock = static::getMock('Masthowasli\ValueObject\Number\Operation\Multiplication');

        static::setExpectedException('\InvalidArgumentException');
        static::assertEquals(new Integer(2), $this->integer->multiply($mock));
    }

    public function testDivision()
    {
        $ten = new Integer(10);
        static::assertEquals(new Integer(2), $ten->divide(new Integer(5)));
        static::assertEquals(new Integer(3), $ten->divide(new Integer(3)));
    }

    public function testDivisionThrowsExceptionWhenDivisorIsZero()
    {
        $this->setExpectedException('\Masthowasli\ValueObject\Number\Exception\DivisionByZero');

        $this->integer->divide(new Integer(0));
    }

    /**
     * @param \Masthowasli\ValueObject\Number\Integer $expected
     * @param \Masthowasli\ValueObject\Number\Integer $divisor
     *
     * @dataProvider testRemainderDataProvider
     */
    public function testRemainder(Integer $expected, Integer $divisor)
    {
        $thirtyFour = new Integer(34);
        static::assertEquals($expected, $thirtyFour->remainder($divisor));
    }

    public function testRemainderDataProvider()
    {
        return [
            [new Integer(34), new Integer(36)],
            [new Integer(34), new Integer(35)],
            [new Integer(0), new Integer(34)],
            [new Integer(1), new Integer(33)],
            [new Integer(2), new Integer(32)],
            [new Integer(3), new Integer(31)],
            [new Integer(4), new Integer(30)],
            [new Integer(5), new Integer(29)],
            [new Integer(6), new Integer(28)],
            [new Integer(7), new Integer(27)],
            [new Integer(8), new Integer(26)],
            [new Integer(9), new Integer(25)],
            [new Integer(10), new Integer(24)],
            [new Integer(11), new Integer(23)],
            [new Integer(12), new Integer(22)],
            [new Integer(13), new Integer(21)],
            [new Integer(14), new Integer(20)],
            [new Integer(15), new Integer(19)],
            [new Integer(16), new Integer(18)],
            [new Integer(0), new Integer(17)],
            [new Integer(2), new Integer(16)],
            [new Integer(4), new Integer(15)],
            [new Integer(6), new Integer(14)],
            [new Integer(8), new Integer(13)],
            [new Integer(10), new Integer(12)],
            [new Integer(1), new Integer(11)],
            [new Integer(4), new Integer(10)],
            [new Integer(7), new Integer(9)],
            [new Integer(2), new Integer(8)],
            [new Integer(6), new Integer(7)],
            [new Integer(4), new Integer(6)],
            [new Integer(4), new Integer(5)],
            [new Integer(2), new Integer(4)],
            [new Integer(1), new Integer(3)],
            [new Integer(0), new Integer(2)],
            [new Integer(0), new Integer(1)],
            [new Integer(0), new Integer(-1)],
            [new Integer(0), new Integer(-2)],
            [new Integer(1), new Integer(-3)],
        ];
    }

    public function testRemainderThrowsExceptionWhenDivisorIsZero()
    {
        $this->setExpectedException('\Masthowasli\ValueObject\Number\Exception\DivisionByZero');

        $this->integer->remainder(new Integer(0));
    }

}
