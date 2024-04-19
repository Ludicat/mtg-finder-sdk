<?php
/**
 * @licence Proprietary
 */
namespace Ludicat\MtgFinder;

use GuzzleHttp\Client as HttpClient;

/**
 * class Client
 *
 * @author Joseph Lemoine<j.lemoine@ludi.cat>
 */
class Client
{
    /** @var string|null */
    protected $apiKey;

    /** @var string|null */
    protected $apiVersion;

    /** @var string|null */
    protected $domain;

    /** @var float|null */
    protected $timeout;

    /** @var HttpClient */
    protected $httpClient;

    /**
     * @param string $apiKey Your API key, you can get one at https://www.mtg-finder.org/api_key/create#/
     * @param string $apiVersion
     * @param string $domain Change it only for testing purposes
     */
    public function __construct(
        $apiKey,
        $apiVersion = 'v1',
        $domain = 'www.mtg-finder.org',
        $timeout = 3.0
    ) {
        $this->apiKey = $apiKey;
        $this->apiVersion = $apiVersion;
        $this->domain = $domain;
        $this->timeout = $timeout;
    }

    public function getHeaders()
    {
        return [
            'Authorization' => 'Bearer ' . $this->getApiKey(),
        ];
    }

    public function getHttpClient(): HttpClient
    {
        if (!$this->httpClient) {
            $this->httpClient = new HttpClient([
                'base_uri' => $this->getUri(),
                'timeout'  => $this->timeout,
                'headers'  => $this->getHeaders(),
            ]);
        }

        return $this->httpClient;
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function getApiVersion(): string
    {
        return $this->apiVersion;
    }

    public function getUri(): string
    {
        return sprintf('https://%s/api/%s/', $this->domain, $this->apiVersion);
    }
}
