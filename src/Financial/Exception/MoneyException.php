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
 * @copyright  2016 - Thomas Sliwa
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */

namespace Masthowasli\ValueObject\Financial\Exception;

use Masthowasli\ValueObject\Comparable;
use Masthowasli\ValueObject\Financial\Currency;

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
class MoneyException extends \Exception
{
    public static function nonPositiveValue(int $value)
    {
        throw new static(
            sprintf('A monetary value must be positive [%d given]', $value),
            10
        );
    }

    public static function nonMoneyValue(Comparable $other) {
        throw new static(
            sprintf('Non monetary value [%s given]', get_class($other)),
            15
        );
    }

    public static function differingCurrencies(Currency $first, Currency $second)
    {
        throw new static(
            sprintf('Cannot process monetary values with different currencies [%s and %s given]', $first->iso(), $second->iso()),
            20
        );
    }

    public static function nonPositiveFactor(float $factor)
    {
        throw new static(
            sprintf('Cannot multiply a monetary value with a non positive factor [%g given]', $factor),
            30
        );
    }

    public static function splitResultsInZeroValue(int $left, int $right)
    {
        throw new static(
            sprintf('Splitting the value by a proportion of %d:%d results in a zero money value', $left, $right),
            40
        );
    }
}