<?php
declare(strict_types=1);
/**
 * File of the Euro currency class
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * PHP version 7.3
 *
 * @category   Masthowasli
 * @package    ValueObjects
 * @subpackage Financial
 * @author     Thomas Sliwa <ts@unfinished.dyndns.org>
 * @copyright  2015-2020 - Thomas Sliwa
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */

namespace Masthowasli\ValueObject\Financial\Currency;

use Masthowasli\ValueObject\Financial\Currency;

/**
 * Class to define an Euro currency value
 *
 * @category   Masthowasli
 * @package    ValueObjects
 * @subpackage Financial
 * @author     Thomas Sliwa <ts@unfinished.dyndns.org>
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */
final class Eur extends Currency
{
    /**
     * @{inheritdoc}
     */
    public function __construct()
    {
        $this->iso4217 = 'EUR';
        $this->symbol = '€';

        parent::__construct();
    }
}
