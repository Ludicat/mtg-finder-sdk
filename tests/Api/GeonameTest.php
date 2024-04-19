<?php
/**
 * @licence Proprietary
 */
namespace Tests\Ludicat\MtgFinder;

use Ludicat\MtgFinder;

/**
 * class GeonameTest
 *
 * @author Joseph Lemoine<j.lemoine@ludi.cat>
 */
class GeonameTest extends \PHPUnit\Framework\TestCase
{
    protected $geoname;

    public function setUp(): void
    {
        $client = new MtgFinder\Client(getenv('APP_TOKEN'));
        $this->geoname = new MtgFinder\Api\Geoname($client);
    }

    public function testGet()
    {
        $geoname = $this->geoname->get(1);
        $this->assertInstanceOf(MtgFinder\Model\Geoname::class, $geoname);
        $this->assertEquals(1, $geoname->getId());
        $this->assertEquals('Canillo', $geoname->getPlaceName());
        $this->assertEquals('AD', $geoname->getCountryCode());
        $this->assertEquals('AD100', $geoname->getPostalCode());
        $this->assertEquals(42.5833, $geoname->getLatitude());
        $this->assertEquals(1.6667, $geoname->getLongitude());
    }

    public function testSearch()
    {
        $geonames = $this->geoname->search('AD', 'Canillo');
        $this->assertIsArray($geonames);
        $this->assertNotEmpty($geonames);
        $this->assertInstanceOf(MtgFinder\Model\Geoname::class, $geonames[0]);
        $this->assertEquals(1, $geonames[0]->getId());
    }

    public function testSearchZip()
    {
        $geonames = $this->geoname->searchZip('AD', 'AD100');
        $this->assertIsArray($geonames);
        $this->assertNotEmpty($geonames);
        $this->assertInstanceOf(MtgFinder\Model\Geoname::class, $geonames[0]);
        $this->assertEquals(1, $geonames[0]->getId());
    }

    public function testSearchCity()
    {
        $geonames = $this->geoname->searchCity('AD', 'Canillo');
        $this->assertIsArray($geonames);
        $this->assertNotEmpty($geonames);
        $this->assertInstanceOf(MtgFinder\Model\Geoname::class, $geonames[0]);
        $this->assertEquals(1, $geonames[0]->getId());
    }

    public function testSearchCoord()
    {
        $geoname = $this->geoname->searchCoord(42.5833, 1.6667);
        $this->assertInstanceOf(MtgFinder\Model\Geoname::class, $geoname);
        $this->assertEquals(1, $geoname->getId());
        $this->assertEquals('Canillo', $geoname->getPlaceName());
        $this->assertEquals('AD', $geoname->getCountryCode());
        $this->assertEquals('AD100', $geoname->getPostalCode());
        $this->assertEquals(42.5833, $geoname->getLatitude());
        $this->assertEquals(1.6667, $geoname->getLongitude());
    }
}
