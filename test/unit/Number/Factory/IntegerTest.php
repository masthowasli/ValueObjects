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

use Masthowasli\ValueObject\Number\Factory\Integer;

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
    public function testFromScalarInt()
    {
        static::assertEquals(new \Masthowasli\ValueObject\Number\Integer(1), Integer::fromScalarInt(1));
        static::assertEquals(new \Masthowasli\ValueObject\Number\Integer(0), Integer::fromScalarInt(0));
        static::assertEquals(new \Masthowasli\ValueObject\Number\Integer(-1), Integer::fromScalarInt(-1));
    }

    /**
     * @param mixed $value
     *
     * @dataProvider fromScalarIntFailDataProvider()
     */
    public function testFromScalarIntFails($value)
    {
        $this->setExpectedException('\InvalidArgumentException');

        Integer::fromScalarInt($value);
    }

    public function fromScalarIntFailDataProvider()
    {
        return [
            [0.1],
            ['0'],
            [false]
        ];
    }

    public function testFromScalarFloat()
    {
        static::assertEquals(new \Masthowasli\ValueObject\Number\Integer(1), Integer::fromScalarFloat(1.0));
        static::assertEquals(new \Masthowasli\ValueObject\Number\Integer(0), Integer::fromScalarFloat(0.0));
        static::assertEquals(new \Masthowasli\ValueObject\Number\Integer(-1), Integer::fromScalarFloat(-1.0));
    }

    /**
     * @param mixed $value
     *
     * @dataProvider fromScalarFloatFailDataProvider()
     */
    public function testFromScalarFloatFails($value)
    {
        $this->setExpectedException('\InvalidArgumentException');

        Integer::fromScalarFloat($value);
    }

    public function fromScalarFloatFailDataProvider()
    {
        return [
            [1],
            ['0'],
            [false]
        ];
    }
}
