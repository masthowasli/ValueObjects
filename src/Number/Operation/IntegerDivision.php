<?php
/**
 * File of the IntegerDivision interface
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * PHP version 5.3.3
 *
 * @category   Masthowasli
 * @package    ValueObjects
 * @author     Thomas Sliwa <ts@unfinished.dyndns.org>
 * @copyright  2015 - Thomas Sliwa
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */

namespace Masthowasli\ValueObject\Number\Operation;

/**
 * Interface to define the divide operation for integers
 *
 * @category   Masthowasli
 * @package    ValueObjects
 * @author     Thomas Sliwa <ts@unfinished.dyndns.org>
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */
interface IntegerDivision extends Division
{
    /**
     * Divides the given value object from the implementing one
     *
     * @param IntegerDivision $valueObject The instance to divide by
     *
     * @return Integer Integer value object representing the remainder
     */
    public function remainder(IntegerDivision $valueObject);
}
