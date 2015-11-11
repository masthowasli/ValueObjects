<?php
/**
 * File of the Integer factory test file
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

namespace Masthowasli\ValueObject\Test\Number\Factory;

use Masthowasli\ValueObject\Number\Factory\Real;
use Masthowasli\ValueObject\Number\Real as RealValueObject;
use Masthowasli\ValueObject\Number\Integer as IntegerValueObject;

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
class RealTest extends \PHPUnit_Framework_TestCase
{
    public function testFromScalarFloat()
    {
        static::assertEquals(new RealValueObject(1), Real::fromScalarFloat(1.0));
        static::assertEquals(new RealValueObject(0), Real::fromScalarFloat(0));
        static::assertEquals(new RealValueObject(-1), Real::fromScalarFloat(-1.0));
    }

    public function testFromScalarInt()
    {
        static::assertEquals(new RealValueObject(1), Real::fromScalarInt(1.0));
        static::assertEquals(new RealValueObject(0), Real::fromScalarInt(0.0));
        static::assertEquals(new RealValueObject(-1), Real::fromScalarInt(-1.0));
    }

    public function testFromInteger()
    {
        static::assertEquals(new RealValueObject(1), Real::fromInteger(new IntegerValueObject(1)));
        static::assertEquals(new RealValueObject(0), Real::fromInteger(new IntegerValueObject(0)));
        static::assertEquals(new RealValueObject(-1), Real::fromInteger(new IntegerValueObject(-1)));
    }

    /**
     * @param mixed $value
     *
     * @dataProvider fromScalarIntFailDataProvider()
     */
    public function testFromScalarIntFails($value)
    {
        $this->setExpectedException('\InvalidArgumentException');

        Real::fromScalarFloat($value);
    }

    public function fromScalarIntFailDataProvider()
    {
        return [
            ['0'],
            [false]
        ];
    }
}
