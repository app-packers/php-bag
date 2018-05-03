<?php

namespace AppPackers\Bag;

/**
 * Class BagAddress.
 */
class BagAddress
{
    /**
     * Street of the address.
     *
     * @var string
     */
    private $street;

    /**
     * Street number of the address.
     *
     * @var int
     */
    private $streetNumber;

    /**
     * City of the address.
     *
     * @var string
     */
    private $city;

    /**
     * Zip code of the address.
     *
     * @var string
     */
    private $zipCode;

    /**
     * Get street.
     *
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * Set street.
     *
     * @param string $street
     */
    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    /**
     * Get street number.
     *
     * @return int
     */
    public function getStreetNumber(): int
    {
        return $this->streetNumber;
    }

    /**
     * Set street number.
     *
     * @param int $streetNumber
     */
    public function setStreetNumber(int $streetNumber): void
    {
        $this->streetNumber = $streetNumber;
    }

    /**
     * Get city.
     *
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * Set city.
     *
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * Get zip code.
     *
     * @return string
     */
    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    /**
     * Set zip code.
     *
     * @param string $zipCode
     */
    public function setZipCode(string $zipCode): void
    {
        $this->zipCode = $zipCode;
    }
}
