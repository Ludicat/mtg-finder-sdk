<?php
/**
 * @licence Proprietary
 */

namespace Tests\Ludicat\MtgFinder;

use Ludicat\MtgFinder;

/**
 * class EventTest
 *
 * @author Joseph Lemoine<j.lemoine@ludi.cat>
 */
class EventTest extends \PHPUnit\Framework\TestCase
{
    protected $event;

    public function setUp(): void
    {
        $client = new MtgFinder\Client(getenv('APP_TOKEN'));
        $this->event = new MtgFinder\Api\Event($client);
    }

    public function testGet()
    {
        $event = $this->event->get('MF-8LT-W9D');
        $this->assertInstanceOf(MtgFinder\Model\Event::class, $event);
        $this->assertEquals('c4a5e83a-6965-4bdf-a08e-545ca65dc893', $event->getUuid());
        $this->assertEquals('MF-8LT-W9D', $event->getCode());
        $this->assertInstanceOf(MtgFinder\Model\User::class, $event->getCreatedBy());
        $this->assertInstanceOf(MtgFinder\Model\Address::class, $event->getAddress());
    }

    protected function getEvent(): MtgFinder\Model\Event
    {
        return new MtgFinder\Model\Event([
            'name' => 'Test event',
            'description' => 'This is a test event',
            'formats' => [
                ['id' => 1]
            ],
            'address' => [
                'street' => '1, rue de la paix',
                'additional' => 'Appartement 42',
                'name' => 'Le bar du coin',
                'latitude' => 48.8566,
                'longitude' => 2.3522,
            ],
            'startAt' => '2020-01-01 00:00:00',
            'endAt' => '2020-01-01 23:59:59',
        ]);
    }

    public function testPost()
    {
        $event = $this->getEvent();
        $this->expectException(MtgFinder\Exception\EventPostException::class);
        $this->event->post($event);
    }

    public function testPostErrors()
    {
        $event = $this->getEvent();

        try {
            $this->event->post($event);
        } catch (MtgFinder\Exception\EventPostException $e) {
            $this->assertEquals(400, $e->getCode());
            $this->assertEquals('Invalid data', $e->getMessage());
            $this->assertIsArray($e->getErrors());
            $this->assertArrayHasKey('maxPeople', $e->getErrors());
            $this->assertArrayHasKey('startAt', $e->getErrors());
            $this->assertArrayHasKey('endAt', $e->getErrors());
        }
    }
}