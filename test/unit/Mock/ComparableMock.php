<?php
declare(strict_types=1);
/**
 * File of the Comparable interface test mock
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * PHP version 7.3
 *
 * @category   Masthowasli
 * @package    ValueObjects
 * @subpackage Test
 * @author     Thomas Sliwa <ts@unfinished.dyndns.org>
 * @copyright  2015-2020 - Thomas Sliwa
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */

namespace Masthowasli\ValueObject\Test\Mock;

use Masthowasli\ValueObject\Comparable;

/**
 * Test mock implementation of the interface to define a natural ordering
 *
 * @category   Masthowasli
 * @package    ValueObjects
 * @subpackage Test
 * @author     Thomas Sliwa <ts@unfinished.dyndns.org>
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */
class ComparableMock implements Comparable
{
    /**
     * @{inheritdoc}
     */
    public function compareTo(Comparable $valueObject) : int
    {
        return 1;
    }
}
