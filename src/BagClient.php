<?php

namespace AppPackers\Bag;

use AppPackers\Bag\Exception\InvalidApiKeyException;
use AppPackers\Bag\Request\BaseRequest;
use AppPackers\Bag\Request\CityRequest;
use AppPackers\Bag\Request\NumberIndicationRequest;
use AppPackers\Bag\Request\PublicSpaceRequest;
use AppPackers\Bag\Response\CityResponse;
use AppPackers\Bag\Response\NumberIndicationResponse;
use AppPackers\Bag\Response\PublicSpaceResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;

/**
 * Class BagClient.
 */
class BagClient
{
    const API_BASE_URL = 'https://bag.basisregistraties.overheid.nl/api/v1';

    /**
     * The Guzzle Client to make requests with.
     *
     * @var Client
     */
    private $client;

    /**
     * The API base url to base full API url's on.
     *
     * @var string
     */
    private $apiBaseUrl = self::API_BASE_URL;

    /**
     * The API key to make requests to BAG.
     *
     * @var string
     */
    private $apiKey;

    /**
     * BagClient constructor.
     */
    public function __construct()
    {
        $this->client = new Client([
            'http_errors' => false,
        ]);
    }

    /**
     * Get the API base url.
     *
     * @return string
     */
    public function getApiBaseUrl(): string
    {
        return $this->apiBaseUrl;
    }

    /**
     * Set the API base url.
     *
     * @param string $apiBaseUrl
     */
    public function setApiBaseUrl(string $apiBaseUrl): void
    {
        $this->apiBaseUrl = rtrim($apiBaseUrl, '/');
    }

    /**
     * Get the API key.
     *
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * Set the API key.
     *
     * @param string $apiKey
     *
     * @throws InvalidApiKeyException
     */
    public function setApiKey(string $apiKey): void
    {
        if (!preg_match('/^[0-9a-z]{8}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{12}$/', $apiKey)) {
            throw new InvalidApiKeyException();
        }

        $this->apiKey = $apiKey;
    }

    /**
     * Get an address by zip code and street number.
     *
     * @param string $zipCode
     * @param int    $streetNumber
     *
     * @throws GuzzleException
     *
     * @return BagAddress
     */
    public function getAddressByZipcodeAndStreetNumber(string $zipCode, int $streetNumber): BagAddress
    {
        $numberingResponse = $this->getNumberingResponse($zipCode, $streetNumber);
        $publicSpaceResponse = $this->getPublicSpaceResponse($numberingResponse->getPublicSpaceId());
        $cityResponse = $this->getCityResponse($publicSpaceResponse->getCityId());

        $address = new BagAddress();
        $address->setStreet($publicSpaceResponse->getStreet());
        $address->setStreetNumber($numberingResponse->getStreetNumber());
        $address->setCity($cityResponse->getCity());
        $address->setZipCode($numberingResponse->getZipCode());

        return $address;
    }

    /**
     * Get a NumberIndicationResponse by zip code and street number.
     *
     * @param string $zipCode
     * @param int    $streetNumber
     *
     * @throws GuzzleException
     *
     * @return NumberIndicationResponse
     */
    private function getNumberingResponse(string $zipCode, int $streetNumber): NumberIndicationResponse
    {
        $numberIndicationRequest = new NumberIndicationRequest();
        $numberIndicationRequest->setZipCode($zipCode);
        $numberIndicationRequest->setStreetNumber($streetNumber);

        $response = $this->send($numberIndicationRequest);

        return new NumberIndicationResponse($response);
    }

    /**
     * Get a PublicSpaceResponse by id.
     *
     * @param string $id
     *
     * @throws GuzzleException
     *
     * @return PublicSpaceResponse
     */
    private function getPublicSpaceResponse(string $id): PublicSpaceResponse
    {
        $publicSpaceRequest = new PublicSpaceRequest();
        $publicSpaceRequest->setId($id);

        $response = $this->send($publicSpaceRequest);

        return new PublicSpaceResponse($response);
    }

    /**
     * Get a CityResponse by id.
     *
     * @param string $id
     *
     * @throws GuzzleException
     *
     * @return CityResponse
     */
    private function getCityResponse(string $id): CityResponse
    {
        $cityRequest = new CityRequest();
        $cityRequest->setId($id);

        $response = $this->send($cityRequest);

        return new CityResponse($response);
    }

    /**
     * Send a bag request.
     *
     * @param BaseRequest $bagRequest
     *
     * @throws GuzzleException
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    private function send(BaseRequest $bagRequest): ResponseInterface
    {
        $request = new Request(
            $bagRequest->getMethod(),
            $this->apiBaseUrl.$bagRequest->getUrl(),
            $this->getHeaders(),
            $bagRequest->getBody()
        );

        return $this->client->send($request);
    }

    /**
     * Get the headers for the request.
     *
     * @return array
     */
    private function getHeaders(): array
    {
        return [
            'X-Api-Key' => $this->apiKey,
            'Accept'    => 'application/hal+json',
        ];
    }
}
