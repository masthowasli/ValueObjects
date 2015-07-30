<?php
/**
 * Created by PhpStorm.
 * User: ts
 * Date: 30.07.15
 * Time: 20:14
 */

namespace Masthowasli\ValueObject\Number;

use Masthowasli\ValueObject\Comparable;
use Masthowasli\ValueObject\Equatable;
use Masthowasli\ValueObject\Number\Number;

class Integer implements Number
{
    /**
     * @var integer The encapsulated value
     */
    private $value;

    public function __construct($value)
    {
        $this->guardValueIsInteger($value);

        $this->value = $value;
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
            throw new \InvalidArgumentException('Only Integers can be compared to Intergers');
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
        if (!$valueObject instanceof static) {
            return false;
        }

        return $this->value === $valueObject->value;
    }

    private function guardValueIsInteger($value)
    {
        if (!\is_int($value)) {
            throw new \InvalidArgumentException(
                'An integer instance must be constructed with a scalar int value'
            );
        }
    }
}
