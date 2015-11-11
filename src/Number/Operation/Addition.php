<?php
/**
 * File of the Addition interface
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
 * Interface to define the add operation
 *
 * @category   Masthowasli
 * @package    ValueObjects
 * @author     Thomas Sliwa <ts@unfinished.dyndns.org>
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */
interface Addition extends Comparable, Equatable
{
    /**
     * Adds the given value object to the implementing one
     *
     * @param Addition $valueObject The value object to add
     *
     * @return Addition Value object representing the sum
     */
    public function add(Addition $valueObject);
}
