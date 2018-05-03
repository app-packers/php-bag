<?php

namespace AppPackers\Bag\Response;

/**
 * Class PublicSpaceResponse.
 */
class PublicSpaceResponse extends BaseResponse
{
    /**
     * The id of the public space.
     *
     * @var string
     */
    private $id;

    /**
     * The street of the public space.
     *
     * @var string
     */
    private $street;

    /**
     * The id of the city.
     *
     * @var string
     */
    private $cityId;

    /**
     * Get the id.
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set the id.
     *
     * @param string $id
     */
    private function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * Get the street.
     *
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * Set the street.
     *
     * @param string $street
     */
    private function setStreet(string $street): void
    {
        $this->street = $street;
    }

    /**
     * Get the city id.
     *
     * @return string
     */
    public function getCityId(): string
    {
        return $this->cityId;
    }

    /**
     * Set city id by city url.
     *
     * @param string $cityUrl
     */
    private function setCityId(string $cityUrl): void
    {
        preg_match('/\/([0-9]*)\?/', $cityUrl, $matches);

        $this->cityId = (string) $matches[1];
    }

    /**
     * Parse the response.
     */
    protected function parse()
    {
        $json = json_decode($this->response->getBody(), true);

        $this->setId($json['identificatiecode']);

        $this->setStreet($json['naam']);

        $this->setCityId($json['_links']['bijbehorendeWoonplaats']['href']);
    }
}
