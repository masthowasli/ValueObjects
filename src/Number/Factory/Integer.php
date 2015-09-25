<?php
/**
 * File of the Integer factory class
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

/**
 * Class defining Integers
 *
 * @category   Masthowasli
 * @package    ValueObjects
 * @subpackage Number
 * @author     Thomas Sliwa <ts@unfinished.dyndns.org>
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */
final class Integer
{
    /**
     * Creates an Integer from a scalar int value
     *
     * @param integer $intValue
     *
     * @throws \InvalidArgumentException
     *
     * @return \Masthowasli\ValueObject\Number\Integer
     */
    public static function fromScalarInt($intValue)
    {
        return new \Masthowasli\ValueObject\Number\Integer($intValue);
    }

    /**
     * Creates an Integer from a scalar float value
     *
     * @param float $floatValue
     *
     * @throws \InvalidArgumentException
     *
     * @return \Masthowasli\ValueObject\Number\Integer
     */
    public static function fromScalarFloat($floatValue)
    {
        if (!is_float($floatValue)) {
            throw new \InvalidArgumentException('Method must be invoked with a scalar float value');
        }

        $intValue = (int) round($floatValue);

        return new \Masthowasli\ValueObject\Number\Integer($intValue);
    }
}
