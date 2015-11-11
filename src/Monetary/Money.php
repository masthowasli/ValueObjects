<?php
/**
 * File of the Money class
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * PHP version 5.3.3
 *
 * @category   Masthowasli
 * @package    ValueObjects
 * @subpackage Monetary
 * @author     Thomas Sliwa <ts@unfinished.dyndns.org>
 * @copyright  2015 - Thomas Sliwa
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */

namespace Masthowasli\ValueObject\Monetary;

use Masthowasli\ValueObject\Comparable;
use Masthowasli\ValueObject\Equatable;
use Masthowasli\ValueObject\Number\Integer;
use Masthowasli\ValueObject\Number\Operation\Addition;
use Masthowasli\ValueObject\Number\Operation\Multiplication;
use Masthowasli\ValueObject\Number\Operation\Subtraction;

/**
 * Class to define a monetary value
 *
 * @category   Masthowasli
 * @package    ValueObjects
 * @subpackage Monetary
 * @author     Thomas Sliwa <ts@unfinished.dyndns.org>
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */
final class Money implements Comparable, Equatable, Addition, Subtraction, Multiplication
{
    /**
     * @var Integer The monetary integer value
     */
    private $value;

    /**
     * @var Currency The currency of the monetary value
     */
    private $currency;

    /**
     * @param \Masthowasli\ValueObject\Number\Integer  $value    The monetary value
     * @param Currency $currency The currency
     */
    public function __construct(Integer $value, Currency $currency)
    {
        $this->value = $value;
        $this->currency = $currency;
    }

    /**
     * Adds the given monetary value to this one
     *
     * @param Addition $other The monetary value to add
     *
     * @throws \InvalidArgumentException On different instanceof or currency
     *
     * @return Money The monetary representation of the addition
     */
    public function add(Addition $other)
    {
        $this->guardComparability($other);

        return new static($this->value->add($other->value), $this->currency);
    }


    /**
     * Subtracts the given monetary value to this one
     *
     * @param Subtraction $other The monetary value to add
     *
     * @throws \InvalidArgumentException On different instanceof or currency
     *
     * @return Money The monetary representation of the addition
     */
    public function subtract(Subtraction $other)
    {
        $this->guardComparability($other);

        return new static($this->value->subtract($other->value), $this->currency);
    }

    /**
     * Multiplies the value with the given factor
     *
     * @param Multiplication $factor The value to multiply with
     *
     * @throws \InvalidArgumentException
     *
     * @return Money The monetary value of the product
     */
    public function multiply(Multiplication $factor)
    {
        return new static($this->value->multiply($factor), $this->currency);
    }

    /**
     * Whether the instance is lower, equal or greater than the given one
     *
     * @param Comparable $other The instance to compare to
     *
     * @throws \InvalidArgumentException On different instanceof or currency
     *
     * @return integer <0 when lower, 0 on equality, >0 when greater
     */
    public function compareTo(Comparable $other)
    {
        $this->guardComparability($other);

        return $this->value->compareTo($other->value);
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
        return $valueObject instanceof Money
            && $this->currency->equals($valueObject->currency)
            && $this->value->equals($valueObject->value);
    }

    private function isComparable($other)
    {
        return $other instanceof Money
            && $this->currency->equals($other->currency);
    }

    private function guardComparability(Comparable $other)
    {
        if ($this->isComparable($other)) {
            return;
        }

        throw new \InvalidArgumentException(
            'You can only compare Money instances one with another'
        );
    }
}
