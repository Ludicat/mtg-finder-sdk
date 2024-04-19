<?php
/**
 * @licence Proprietary
 */

namespace Ludicat\MtgFinder\Api;

use Ludicat\MtgFinder\Client;
use Ludicat\MtgFinder\Model\Geoname as GeonameModel;

/**
 * class Geonames
 *
 * @author Joseph Lemoine<j.lemoine@ludi.cat>
 */
class Geoname
{
    public const ENDPOINT_GET = 'geoname/%d';
    public const ENDPOINT_SEARCH = 'geoname/search/%s/%s';
    public const ENDPOINT_SEARCH_ZIP = 'geoname/search-zip/%s/%s';
    public const ENDPOINT_SEARCH_CITY = 'geoname/search-city/%s/%s';
    public const ENDPOINT_SEARCH_COORD = 'geoname/search-coord/%s/%s';

    /** @var Client */
    protected $client;

    public function __construct(
        Client $client
    )
    {
        $this->client = $client;
    }

    /**
     * @return GeonameModel|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(int $id): ?GeonameModel
    {
        $response = $this->client->getHttpClient()->get(sprintf(self::ENDPOINT_GET, $id));

        $data = json_decode($response->getBody()->getContents(), true);
        if (empty($data)) {
            return null;
        }

        return new GeonameModel($data);
    }

    /**
     * @param string $country
     * @param string $pattern
     *
     * @return array<GeonameModel>
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function search(string $country, string $pattern): array
    {
        $response = $this->client->getHttpClient()->get(sprintf(self::ENDPOINT_SEARCH, $country, $pattern));

        $out = [];
        $data = json_decode($response->getBody()->getContents(), true);
        foreach ($data as $geoname) {
            $out[] = new GeonameModel($geoname);
        }

        return $out;
    }

    /**
     * @param string $country
     * @param string $pattern
     *
     * @return array<GeonameModel>
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function searchZip(string $country, string $pattern): array
    {
        $response = $this->client->getHttpClient()->get(sprintf(self::ENDPOINT_SEARCH_ZIP, $country, $pattern));

        $out = [];
        $data = json_decode($response->getBody()->getContents(), true);
        foreach ($data as $geoname) {
            $out[] = new GeonameModel($geoname);
        }

        return $out;
    }

    /**
     * @param string $country
     * @param string $pattern
     *
     * @return array<GeonameModel>
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function searchCity(string $country, string $pattern): array
    {
        $response = $this->client->getHttpClient()->get(sprintf(self::ENDPOINT_SEARCH_CITY, $country, $pattern));

        $out = [];
        $data = json_decode($response->getBody()->getContents(), true);
        foreach ($data as $geoname) {
            $out[] = new GeonameModel($geoname);
        }

        return $out;
    }

    /**
     * Get the closest city CENTRAL POINT from the given coordinates.
     * Be careful you may retrieve the wrong city, it's just an approximation.
     *
     * @param string $latitude
     * @param string $longitude
     *
     * @return GeonameModel|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function searchCoord(string $latitude, string $longitude): ?GeonameModel
    {
        $response = $this->client->getHttpClient()->get(sprintf(self::ENDPOINT_SEARCH_COORD, $latitude, $longitude));

        $data = json_decode($response->getBody()->getContents(), true);
        if (empty($data)) {
            return null;
        }

        return new GeonameModel($data);
    }
}
