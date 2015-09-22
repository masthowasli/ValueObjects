<?php
/**
 * File of the DivisionByZero exception class
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * PHP version 5.3.3
 *
 * @category   Masthowasli
 * @package    ValueObjects
 * @subpackage Exception
 * @author     Thomas Sliwa <ts@unfinished.dyndns.org>
 * @copyright  2015 - Thomas Sliwa
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */

namespace Masthowasli\ValueObject\Exception;

/**
 * Class for the division by zero exception
 *
 * @category   Masthowasli
 * @package    ValueObjects
 * @subpackage Exception
 * @author     Thomas Sliwa <ts@unfinished.dyndns.org>
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */
class DivisionByZero extends \Exception
{
    /**
     * @{inheritdoc}
     */
    public function __construct($message = "", $code = 0, \Exception $previous = null)
    {
        if ('' === $message) {
            $message = 'Division by Zero';
        }

        parent::__construct($message, $code, $previous);
    }
}
