<?php
/**
 * @licence Proprietary
 */
namespace Ludicat\MtgFinder\Api;

use GuzzleHttp\Exception\BadResponseException;
use Ludicat\MtgFinder\Client;
use Ludicat\MtgFinder\Exception\EventPostException;
use Ludicat\MtgFinder\Model\Event as EventModel;

/**
 * class Event
 *
 * @author Joseph Lemoine<j.lemoine@ludi.cat>
 */
class Event
{
    public const ENDPOINT_POST = 'event';
    public const ENDPOINT_ALL = 'event/%s';

    /** @var Client */
    protected $client;

    public function __construct(
        Client $client
    )
    {
        $this->client = $client;
    }

    /**
     * You just have to set format ID in format object and geoname ID in the geoname object for the address.
     *
     * @param EventModel $event
     *
     * @return EventModel|null
     * @throws EventPostException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post(EventModel $event): ?EventModel
    {
        try {
            $response = $this->client->getHttpClient()->post(self::ENDPOINT_POST, ['form_params' => $event->toArray()]);
        } catch (BadResponseException $e) {
            $response = $e->getResponse();
            if ($response->getStatusCode() === 400) {
                throw new EventPostException('Invalid data', 400, $e, json_decode($response->getBody()->getContents(), true));
            }

            throw $e;
        }

        $data = json_decode($response->getBody()->getContents(), true);
        if (empty($data)) {
            return null;
        }

        return new EventModel($data);
    }

    /**
     * You just have to set format ID in format object and geoname ID in the geoname object for the address.
     *
     * @param EventModel $event
     *
     * @return EventModel|null
     * @throws EventPostException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function put(EventModel $event): ?EventModel
    {
        try {
            $response = $this->client->getHttpClient()->put(self::ENDPOINT_ALL, ['form_params' => $event->toArray()]);
        } catch (BadResponseException $e) {
            $response = $e->getResponse();
            if ($response->getStatusCode() === 400) {
                throw new EventPostException('Invalid data', 400, $e, json_decode($response->getBody()->getContents(), true));
            }

            throw $e;
        }

        $data = json_decode($response->getBody()->getContents(), true);
        if (empty($data)) {
            return null;
        }

        return new EventModel($data);
    }

    /**
     * You just have to set format ID in format object and geoname ID in the geoname object for the address.
     *
     * @param EventModel $event
     *
     * @return EventModel|null
     * @throws EventPostException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete(EventModel $event): bool
    {
        try {
            $this->client->getHttpClient()->delete(self::ENDPOINT_ALL, ['form_params' => $event->toArray()]);
        } catch (BadResponseException $e) {
            $response = $e->getResponse();
            if ($response->getStatusCode() === 400) {
                throw new EventPostException('Invalid data', 400, $e, json_decode($response->getBody()->getContents(), true));
            }

            throw $e;
        }

        return true;
    }

    public function get(string $code): ?EventModel
    {
        $response = $this->client->getHttpClient()->get(sprintf(self::ENDPOINT_ALL, $code));

        $data = json_decode($response->getBody()->getContents(), true);
        if (empty($data)) {
            return null;
        }

        return new EventModel($data);
    }
}