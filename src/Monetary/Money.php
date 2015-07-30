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
class Money implements Comparable, Equatable
{
    /**
     * @var integer The monetary integer value
     */
    private $value;

    /**
     * @var Currency The currency of the monetary value
     */
    private $currency;

    /**
     * @param integer  $value    The monetary value
     * @param Currency $currency The currency
     */
    public function __construct($value, Currency $currency)
    {
        $this->guardValueIsInteger($value);
        $this->value = $value;
        $this->currency = $currency;
    }

    /**
     * Whether the instance is lower, equal or greater than the given one
     *
     * @param Comparable $valueObject The instance to compare to
     *
     * @return integer <0 when lower, 0 on equality, >0 when greater
     */
    public function compareTo(Comparable $valueObject)
    {
        if (!$valueObject instanceof Money
            || !$this->currency->equals($valueObject->currency)
        ) {
            throw new \InvalidArgumentException(
                'You can only compare Money instances one with another'
            );
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
     * @return boolean Whether the twon instances are equal
     */
    public function equals(Equatable $valueObject)
    {
        return $valueObject instanceof Money
            && $this->currency->equals($valueObject->currency)
            && $this->value === $valueObject->value;
    }

    private function guardValueIsInteger($value)
    {
        if (!\is_int($value)) {
            throw new \InvalidArgumentException('The value must be of type integer');
        }
    }
}
