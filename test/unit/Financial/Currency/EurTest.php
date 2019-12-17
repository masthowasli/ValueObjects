<?php
declare(strict_types=1);
/**
 * File of the Eur test file
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * PHP version 7.3
 *
 * @category   Masthowasli
 * @package    ValueObject
 * @subpackage Test
 * @author     Thomas Sliwa <ts@unfinished.dyndns.org>
 * @copyright  2015-2020 - Thomas Sliwa
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */

namespace Masthowasli\ValueObject\Test\Financial\Currency;

use Masthowasli\ValueObject\Financial\Currency;
use Masthowasli\ValueObject\Financial\Currency\Eur;
use Masthowasli\ValueObject\Financial\Currency\Usd;
use PHPUnit\Framework\TestCase;

/**
 * Tests the Eur currency value object
 *
 * @category   Masthowasli
 * @package    ValueObject
 * @subpackage Test
 * @author     Thomas Sliwa <ts@unfinished.dyndns.org>
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */
class EurTest extends TestCase
{
    /**
     * @var Currency
     */
    private $currency;

    /**
     * @{inheritdoc}
     */
    protected function setup(): void
    {
        $this->currency = new Eur();
    }

    public function testEqualsReturnsTrue(): void
    {
        static::assertTrue($this->currency->equals(new Eur()));
    }

    public function testEqualsReturnsFalse(): void
    {
        static::assertFalse($this->currency->equals(new Usd()));
    }

    public function testTextualRepresentation(): void
    {
        static::assertEquals('€', (string) $this->currency);
    }

    public function testIso(): void
    {
        static::assertEquals('EUR', $this->currency->iso());
    }
}
