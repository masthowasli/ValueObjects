<?php
/**
 * File of the Real number class
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

use Masthowasli\ValueObject\Comparable;
use Masthowasli\ValueObject\Equatable;
use Masthowasli\ValueObject\Number\Exception\DivisionByZero;
use Masthowasli\ValueObject\Number\Operation\Addition;
use Masthowasli\ValueObject\Number\Operation\Subtraction;
use Masthowasli\ValueObject\Number\Operation\Multiplication;
use Masthowasli\ValueObject\Number\Operation\Division;

/**
 * Class defining Real numbers
 *
 * @category   Masthowasli
 * @package    ValueObjects
 * @subpackage Number
 * @author     Thomas Sliwa <ts@unfinished.dyndns.org>
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */
final class Real implements Number
{
    /**
     * @var float The encapsulated value
     */
    private $value;

    /**
     * Instantiates a Real
     *
     * @param float $value The value to represent
     */
    public function __construct($value)
    {
        $this->guardValueIsFloat($value);

        $this->value = (float) $value;
    }

    /**
     * Performs an addition of the given Real with the instance
     *
     * @param \Masthowasli\ValueObject\Number\Operation\Addition $other The Real value object to add
     *
     * @throws \InvalidArgumentException
     *
     * @return Real The value object representing the summed value
     */
    public function add(Addition $other)
    {
        if (!$other instanceof Real) {
            throw new \InvalidArgumentException('Only Real objects may be added');
        }

        return new Real($this->value + $other->value);
    }

    /**
     * Performs a subtraction of the given Real with the instance
     *
     * @param \Masthowasli\ValueObject\Number\Operation\Subtraction $other The Real value object to subtract
     *
     * @throws \InvalidArgumentException
     *
     * @return Real The value object representing the difference value
     */
    public function subtract(Subtraction $other)
    {
        if (!$other instanceof Real) {
            throw new \InvalidArgumentException('Only Real objects may be subtracted');
        }

        return new Real($this->value - $other->value);
    }

    /**
     * Performs a multiplication of the given Real with the instance
     *
     * @param \Masthowasli\ValueObject\Number\Operation\Multiplication $other The Real value object to multiply
     *
     * @throws \InvalidArgumentException
     *
     * @return Real The value object representing the product value
     */
    public function multiply(Multiplication $other)
    {
        if (!$other instanceof Real) {
            throw new \InvalidArgumentException('Only Real objects may be multiplied');
        }

        return new Real($this->value * $other->value);
    }

    /**
     * Performs a division of the given Real with the instance
     *
     * @param \Masthowasli\ValueObject\Number\Operation\Division $other The Real value object to divide by
     *
     * @throws \Masthowasli\ValueObject\Number\Exception\DivisionByZero
     *
     * @return Real The value object representing the quotient
     */
    public function divide(Division $other)
    {
        $this->guardDivisorIsNotZero($other);

        return new Real($this->value / $other->value);
    }

    /**
     * Whether the instance is lower, equal or greater than the given one
     *
     * @param Comparable $valueObject The instance to compare to
     *
     * @throws \InvalidArgumentException On non Integer arguments
     *
     * @return integer <0 when lower, 0 on equality, >0 when greater
     */
    public function compareTo(Comparable $valueObject)
    {
        if (!$valueObject instanceof static) {
            throw new \InvalidArgumentException('Only Integers can be compared to Integers');
        }

        if ($this->value === $valueObject->value) {
            return 0;
        }

        return $this->value < $valueObject->value ? -1 : 1;
    }

    /**
     * Whether the instance equals the given instance
     *
     * A type check must be performed in an implementing class
     *
     * @param Equatable $valueObject The instance to check against
     *
     * @return boolean Whether the two instances are equal
     */
    public function equals(Equatable $valueObject)
    {
        if (!$valueObject instanceof static) {
            return false;
        }

        return $this->value === $valueObject->value;
    }

    private function guardValueIsFloat($value)
    {
        if (\is_int($value) || \is_float($value)) {
            return;
        }

        throw new \InvalidArgumentException(
            'A Real instance must be constructed with a scalar int or float value'
        );
    }

    private function guardDivisorIsNotZero(Real $divisor)
    {
        if ($divisor->equals(new static(0))) {
            throw new DivisionByZero();
        }
    }
}
