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
 * Tests the Money value object
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
     * @var Integer
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
        $this->assertInstanceOf(
            'Masthowasli\ValueObject\Number\Integer',
            $this->integer
        );
    }

    public function testConstructionFailsWithFloat()
    {
        $this->setExpectedException('\InvalidArgumentException');

        new Integer(1.0);
    }

    public function testConstructionFailsWithString()
    {
        $this->setExpectedException('\InvalidArgumentException');

        new Integer("1");
    }

    public function testConstructionFailsWithBoolean()
    {
        $this->setExpectedException('\InvalidArgumentException');

        new Integer(true);
    }

    public function testEqualsReturnsTrue()
    {
        $this->assertTrue($this->integer->equals(new Integer(1)));
    }

    public function testEqualsReturnsFalseForNonMoneyArgument()
    {
        $mock = $this->getMock('Masthowasli\ValueObject\Number\Number');

        $this->assertFalse($this->integer->equals($mock));
    }

    public function testEqualsReturnsFalseForDifferentvalues()
    {
        $this->assertFalse($this->integer->equals(new Integer(2)));
    }

    public function testCompareToReturnsNegativeForLargerArgumentValue()
    {
        $this->assertLessThan(0, $this->integer->compareTo(new Integer(2)));
    }

    public function testCompareToReturnsPositiveForSmallerArgumentValue()
    {
        $this->assertGreaterThan(0, $this->integer->compareTo(new Integer(0)));
    }

    public function testCompareToReturnsZeroForEqualArgumentValue()
    {
        $this->assertEquals(0, $this->integer->compareTo(new Integer(1)));
    }

    public function testCompareToThrowsAnExceptionForNonIntegerComparableInstance()
    {
        $mock = $this->getMock('Masthowasli\ValueObject\Comparable');
        $this->setExpectedException('\InvalidArgumentException');
        $this->assertEquals(0, $this->integer->compareTo($mock));
    }

    public function testAddition()
    {
        $this->assertEquals(new Integer(2), $this->integer->add(new Integer(1)));
    }

    public function testSubstration()
    {
        $this->assertEquals(new Integer(0), $this->integer->subtract(new Integer(1)));
    }

    public function testMultiplication()
    {
        $this->assertEquals(new Integer(5), $this->integer->multiply(new Integer(5)));
    }

    public function testDivision()
    {
        $ten = new Integer(10);
        $this->assertEquals(new Integer(2), $ten->divide(new Integer(5)));
        $this->assertEquals(new Integer(3), $ten->divide(new Integer(3)));
    }

    public function testRemainder()
    {
        $seventeen = new Integer(17);
        $this->assertEquals(new Integer(7), $seventeen->remainder(new Integer(10)));
        $this->assertEquals(new Integer(7), $seventeen->remainder(new Integer(10)));
        $this->assertEquals(new Integer(0), $seventeen->remainder(new Integer(17)));
        $this->assertEquals(new Integer(1), $seventeen->remainder(new Integer(16)));
        $this->assertEquals(new Integer(2), $seventeen->remainder(new Integer(15)));
        $this->assertEquals(new Integer(3), $seventeen->remainder(new Integer(14)));
        $this->assertEquals(new Integer(4), $seventeen->remainder(new Integer(13)));
        $this->assertEquals(new Integer(5), $seventeen->remainder(new Integer(12)));
    }
}
