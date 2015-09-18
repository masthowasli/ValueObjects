<?php
/**
 * File of the Subtraction interface
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

namespace Masthowasli\ValueObject;

/**
 * Interface to define the subtract operation
 *
 * @category   Masthowasli
 * @package    ValueObjects
 * @author     Thomas Sliwa <ts@unfinished.dyndns.org>
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */
interface Subtraction
{
    /**
     * Subtracts the given value object from the implementing one
     *
     * @param Subtraction $valueObject The instance to subtract
     *
     * @return Subtraction Value object representing the difference
     */
    public function subtract(Subtraction $valueObject);
}
