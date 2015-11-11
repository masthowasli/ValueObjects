<?php
/**
 * File of the abstract NonComplexNumber class
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
 * Abstract class defining non complex numbers
 *
 * @category   Masthowasli
 * @package    ValueObjects
 * @subpackage Number
 * @author     Thomas Sliwa <ts@unfinished.dyndns.org>
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */
abstract class NonComplexNumber implements Number
{
    /**
     * @var mixed The encapsulated value
     */
    protected $value;

    /**
     * Instantiates a Real
     *
     * @param float $value The value to represent
     */
    public function __construct($value)
    {
        $this->guardConstructionValue($value);

        $this->value = $this->castScalarValue($value);
    }

    /**
     * Performs an addition of the given non complex number with the instance
     *
     * @param \Masthowasli\ValueObject\Number\Operation\Addition $other The non complex number value object to add
     *
     * @throws \InvalidArgumentException
     *
     * @return Real The value object representing the summed value
     */
    public function add(Addition $other)
    {
        if (!$other instanceof static) {
            throw new \InvalidArgumentException('Only non complex numbers of the same type may be added');
        }

        return new static($this->value + $other->value);
    }

    /**
     * Performs a subtraction of the given non complex number with the instance
     *
     * @param \Masthowasli\ValueObject\Number\Operation\Subtraction $other The non complex number value object to subtract
     *
     * @throws \InvalidArgumentException
     *
     * @return Real The value object representing the difference value
     */
    public function subtract(Subtraction $other)
    {
        if (!$other instanceof static) {
            throw new \InvalidArgumentException('Only non complex numbers of the same type may be subtracted');
        }

        return new static ($this->value - $other->value);
    }

    /**
     * Performs a multiplication of the given non complex number with the instance
     *
     * @param \Masthowasli\ValueObject\Number\Operation\Multiplication $other The non complex number value object to multiply
     *
     * @throws \InvalidArgumentException
     *
     * @return Real The value object representing the product value
     */
    public function multiply(Multiplication $other)
    {
        if (!$other instanceof static) {
            throw new \InvalidArgumentException('Only non complex numbers of the same type may be multiplied');
        }

        return new static($this->value * $other->value);
    }

    /**
     * Performs a division of the given non complex number with the instance
     *
     * @param \Masthowasli\ValueObject\Number\Operation\Division $other The non complex number value object to divide by
     *
     * @throws \Masthowasli\ValueObject\Number\Exception\DivisionByZero
     *
     * @return Real The value object representing the quotient
     */
    public function divide(Division $other)
    {
        $this->guardDivisorIsNotZero($other);

        return new static($this->value / $other->value);
    }

    /**
     * Whether the instance is lower, equal or greater than the given one
     *
     * @param Comparable $valueObject The instance to compare to
     *
     * @throws \InvalidArgumentException On non non complex number arguments
     *
     * @return integer <0 when lower, 0 on equality, >0 when greater
     */
    public function compareTo(Comparable $valueObject)
    {
        if (!$valueObject instanceof static) {
            throw new \InvalidArgumentException('Only Numbers of the same type can be compared');
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

    abstract protected function guardConstructionValue($value);

    abstract protected function castScalarValue($value);

    protected function guardDivisorIsNotZero(NonComplexNumber $divisor)
    {
        if ($divisor->equals(new static(0))) {
            throw new DivisionByZero();
        }
    }
}
