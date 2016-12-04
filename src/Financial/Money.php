<?php
declare(strict_types=1);
/**
 * File of the Money class
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * PHP version 7.0
 *
 * @category   Masthowasli
 * @package    ValueObjects
 * @subpackage Financial
 * @author     Thomas Sliwa <ts@unfinished.dyndns.org>
 * @copyright  2015-2016 - Thomas Sliwa
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */

namespace Masthowasli\ValueObject\Financial;

use Masthowasli\ValueObject\Financial\Exception\MoneyException;
use Masthowasli\ValueObject\Comparable;
use Masthowasli\ValueObject\Equatable;

/**
 * Class to define a monetary value
 *
 * @category   Masthowasli
 * @package    ValueObjects
 * @subpackage Financial
 * @author     Thomas Sliwa <ts@unfinished.dyndns.org>
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */
final class Money implements Comparable, Equatable
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
     * @param int $value The monetary value
     * @param Currency $currency The currency
     *
     * @throws MoneyException
     */
    public function __construct(int $value, Currency $currency)
    {
        if ($value <= 0) {
            MoneyException::nonPositiveValue($value);
        }
        $this->value = $value;
        $this->currency = $currency;
    }

    /**
     * Adds the given monetary value to this one
     *
     * @param Money $other The monetary value to add
     *
     * @throws MoneyException On different instanceof or currency
     *
     * @return Money The monetary representation of the addition
     */
    public function add(Money $other) : Money
    {
        $this->guardCurrencies($other);

        return new static($this->value + $other->value, $this->currency);
    }


    /**
     * Subtracts the given monetary value to this one
     *
     * @param Money $other The monetary value to add
     *
     * @throws MoneyException On different instanceof or currency
     *
     * @return Money The monetary representation of the addition
     */
    public function subtract(Money $other) : Money
    {
        $this->guardCurrencies($other);

        return new static($this->value - $other->value, $this->currency);
    }

    /**
     * Multiplies the value with the given factor
     *
     * @param float $factor The value to multiply with
     *
     * @throws MoneyException
     *
     * @return Money The monetary value of the product
     */
    public function multiply(float $factor) : Money
    {
        if ($factor <= 0) {
            MoneyException::nonPositiveFactor($factor);
        }

        $normalizedFactor = floor($factor * 100) / 100;

        return new static((int) round($this->value * $normalizedFactor), $this->currency);
    }

    /**
     * Splits the money value given by the proportional values
     *
     * The method always gives the left proportion a possible remainder, given in the example:
     *
     * when one splits 5 cents in a 1:1 proportion the values 3 and 2 cents are returned
     *
     * @param int $leftProportion
     * @param int $rightProportion
     *
     * @throws MoneyException
     *
     * @return array Of the split money values
     */
    public function split(int $leftProportion, int $rightProportion)
    {
        try {
            $leftValue = new Money(
                (int) ceil($this->value * ($leftProportion / ($leftProportion + $rightProportion))),
                $this->currency
            );
        } catch (MoneyException $e) {
            MoneyException::splitResultsInZeroValue($leftProportion, $rightProportion);
        }

        try {
            $rightValue = new Money(
                (int) floor($this->value * ($rightProportion / ($leftProportion + $rightProportion))),
                $this->currency
            );
        } catch (MoneyException $e) {
            MoneyException::splitResultsInZeroValue($leftProportion, $rightProportion);
        }

        return [$leftValue, $rightValue];
    }

    /**
     * Whether the instance is lower, equal or greater than the given one
     *
     * @param Comparable $other The instance to compare to
     *
     * @throws MoneyException On different instanceof or currency
     *
     * @return integer <0 when lower, 0 on equality, >0 when greater
     */
    public function compareTo(Comparable $other) : int
    {
        if (!$other instanceof Money) {
            MoneyException::nonMoneyValue($other);
        }

        $this->guardCurrencies($other);
        if ($this->value === $other->value) {
            return 0;
        }

        return $this->value < $other->value ? -1 : 1;
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
    public function equals(Equatable $valueObject) : bool
    {
        return $valueObject instanceof Money
            && $this->currency->equals($valueObject->currency)
            && $this->value === $valueObject->value;
    }

    private function guardCurrencies(Money $other)
    {
        if (!$this->currency->equals($other->currency)) {
            MoneyException::differingCurrencies($this->currency, $other->currency);
        }
    }
}
