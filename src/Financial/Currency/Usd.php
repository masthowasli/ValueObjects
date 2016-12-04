<?php
declare(strict_types=1);;
/**
 * File of the US Dollar currency class
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
 * @copyright  2015-2016 - Thomas Sliwa
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */

namespace Masthowasli\ValueObject\Financial\Currency;

use Masthowasli\ValueObject\Financial\Currency;

/**
 * Class to define an US Dollar currency value
 *
 * @category   Masthowasli
 * @package    ValueObjects
 * @subpackage Financial
 * @author     Thomas Sliwa <ts@unfinished.dyndns.org>
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */
final class Usd extends Currency
{
    /**
     * @{inheritdoc}
     */
    public function __construct()
    {
        $this->iso4217 = 'USD';
        $this->symbol = '$';

        parent::__construct();
    }
}
