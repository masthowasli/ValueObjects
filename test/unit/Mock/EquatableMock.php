<?php
declare(strict_types=1);
/**
 * File of the Equatable interface test mock
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * PHP version 7.0
 *
 * @category   Masthowasli
 * @package    ValueObjects
 * @subpackage Test
 * @author     Thomas Sliwa <ts@unfinished.dyndns.org>
 * @copyright  2015-2016 - Thomas Sliwa
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */

namespace Masthowasli\ValueObject\Test\Mock;

use Masthowasli\ValueObject\Equatable;

/**
 * Test mock implementation of the interface to define equality checks
 *
 * @category   Masthowasli
 * @package    ValueObjects
 * @subpackage Test
 * @author     Thomas Sliwa <ts@unfinished.dyndns.org>
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */
class EquatableMock implements Equatable
{
    /**
     * @{inheritdoc}
     */
    public function equals(Equatable $valueObject) : bool
    {
        return false;
    }
}
