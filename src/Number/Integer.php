<?php
/**
 * File of the Integer class
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

namespace Masthowasli\ValueObject\Number;

use Masthowasli\ValueObject\Number\Operation\Division;
use Masthowasli\ValueObject\Number\Operation\IntegerDivision;

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
final class Integer extends NonComplexNumber implements IntegerDivision
{
    /**
     * Gives a textural representation of this value
     *
     * @return string The textual representation of the value
     */
    public function __toString()
    {
        return (string) $this->value;
    }

    /**
     * Performs an integer division of the given Integer with the instance
     *
     * @param \Masthowasli\ValueObject\Number\Operation\Division $other The Integer value object to divide by
     *
     * @throws \Masthowasli\ValueObject\Number\Exception\DivisionByZero
     *
     * @return Integer The value object representing the integer quotient
     */
    public function divide(Division $other)
    {
        $this->guardDivisorIsNotZero($other);

        $newValue = clone $this;
        $newValue->value = floor($newValue->value / $other->value);

        return $newValue;
    }

    /**
     * Performs the remainder calculation of the integer division of the given Integer with the instance
     *
     * @param \Masthowasli\ValueObject\Number\Operation\IntegerDivision $other The Integer value object to get the division remainder from
     *
     * @return Integer The remainder of the integer division
     */
    public function remainder(IntegerDivision $other)
    {
        $this->guardDivisorIsNotZero($other);

        $newValue = clone $this;
        $newValue->value %= $other->value;

        return $newValue;
    }

    protected function guardConstructionValue($value)
    {
        if (!\is_int($value)) {
            throw new \InvalidArgumentException(
                'An Integer instance must be constructed with a scalar int value'
            );
        }
    }

    protected function castScalarValue($value)
    {
        return (int) $value;
    }
}
