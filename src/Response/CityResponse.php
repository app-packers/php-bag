<?php

namespace AppPackers\Bag\Response;

/**
 * Class CityResponse.
 */
class CityResponse extends BaseResponse
{
    /**
     * The identification of the city.
     *
     * @var string
     */
    private $id;

    /**
     * The name of the city.
     *
     * @var string
     */
    private $city;

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
     * Get the city.
     *
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * Set the city.
     *
     * @param string $city
     */
    private function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * Parse the response.
     */
    protected function parse()
    {
        $json = json_decode($this->response->getBody(), true);

        $this->setId($json['identificatiecode']);
        $this->setCity($json['naam']);
    }
}
