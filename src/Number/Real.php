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
final class Real extends NonComplexNumber
{
    public function __toString()
    {
        return (string) $this->value;
    }

    protected function guardConstructionValue($value)
    {
        if (\is_int($value) || \is_float($value)) {
            return;
        }

        throw new \InvalidArgumentException(
            'A Real instance must be constructed with a scalar int or float value'
        );
    }

    protected function castScalarValue($value)
    {
        return (float) $value;
    }
}
