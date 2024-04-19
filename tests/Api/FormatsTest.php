<?php
/**
 * @licence Proprietary
 */
namespace Tests\Ludicat\MtgFinder;

use Ludicat\MtgFinder;
/**
 * class FormatsTest
 *
 * @author Joseph Lemoine<j.lemoine@ludi.cat>
 */
class FormatsTest extends \PHPUnit\Framework\TestCase
{
    protected $formats;

    public function setUp(): void
    {
        $client = new MtgFinder\Client(getenv('APP_TOKEN'));
        $this->formats = new MtgFinder\Api\Formats($client);
    }

    public function testGet()
    {
        $formats = $this->formats->get();
        $this->assertIsArray($formats);
        $this->assertGreaterThan(0, count($formats));
        $this->assertInstanceOf(MtgFinder\Model\Format::class, $formats[0]);
    }
}
