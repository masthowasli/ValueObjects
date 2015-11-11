<?php
/**
 * File of the Real factory class
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * PHP version 5.3.3
 *
 * @category   Masthowasli
 * @package    ValueObjects
 * @subpackage Number
 * @author     Thomas Sliwa <ts@unfinished.dyndns.org>
 * @copyright  2015 - Thomas Sliwa
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */

namespace Masthowasli\ValueObject\Number\Factory;

use Masthowasli\ValueObject\Number\Integer as IntegerValue;
use Masthowasli\ValueObject\Number\Real as RealValue;

/**
 * Class defining Real real numbers
 *
 * @category   Masthowasli
 * @package    ValueObjects
 * @subpackage Number
 * @author     Thomas Sliwa <ts@unfinished.dyndns.org>
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */
final class Real
{
    /**
     * Creates an Real from a scalar int value
     *
     * @param integer $intValue
     *
     * @throws \InvalidArgumentException
     *
     * @return \Masthowasli\ValueObject\Number\Real
     */
    public static function fromScalarInt($intValue)
    {
        return new RealValue($intValue);
    }

    /**
     * Creates an Real from a scalar float value
     *
     * @param float $floatValue
     *
     * @throws \InvalidArgumentException
     *
     * @return \Masthowasli\ValueObject\Number\Real
     */
    public static function fromScalarFloat($floatValue)
    {
        return new RealValue($floatValue);
    }

    /**
     * @param \Masthowasli\ValueObject\Number\Integer $integerValue
     *
     * @return RealValue
     */
    public static function fromInteger(IntegerValue $integerValue)
    {
        return new RealValue((int) ((string) $integerValue));
    }
}
