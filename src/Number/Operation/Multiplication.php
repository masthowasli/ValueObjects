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

namespace Masthowasli\ValueObject\Number\Operation;

use Masthowasli\ValueObject\Comparable;
use Masthowasli\ValueObject\Equatable;

/**
 * Interface to define the subtract operation
 *
 * @category   Masthowasli
 * @package    ValueObjects
 * @author     Thomas Sliwa <ts@unfinished.dyndns.org>
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */
interface Multiplication extends Comparable, Equatable
{
    /**
     * Multiplies the given value object from the implementing one
     *
     * @param Multiplication $valueObject The instance to multiply
     *
     * @return Multiplication Value object representing the product
     */
    public function multiply(Multiplication $valueObject);
}
