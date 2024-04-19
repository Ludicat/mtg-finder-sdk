<?php
/**
 * @licence Proprietary
 */

namespace Ludicat\MtgFinder\Api;

use Ludicat\MtgFinder\Client;
use Ludicat\MtgFinder\Model\Format;

/**
 * class Formats
 *
 * @author Joseph Lemoine<j.lemoine@ludi.cat>
 */
class Formats
{
    public const ENDPOINT = 'formats';

    /** @var Client */
    protected $client;

    public function __construct(
        Client $client
    )
    {
        $this->client = $client;
    }

    /**
     * @return array<Format>
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(): array
    {
        $response = $this->client->getHttpClient()->get(self::ENDPOINT);

        $out = [];
        $data = json_decode($response->getBody()->getContents(), true);
        foreach ($data as $format) {
            $out[] = new Format($format);
        }

        return $out;
    }
}
