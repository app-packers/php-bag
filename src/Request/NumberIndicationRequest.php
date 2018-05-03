<?php

namespace AppPackers\Bag\Request;

/**
 * Class NumberIndicationRequest.
 */
class NumberIndicationRequest implements BaseRequest
{
    /**
     * The zip code of the number indication.
     *
     * @var string
     */
    private $zipCode;

    /**
     * The street number of the number indication.
     *
     * @var int
     */
    private $streetNumber;

    /**
     * Get the zip code.
     *
     * @return string
     */
    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    /**
     * Set the zip code.
     *
     * @param string $zipCode
     */
    public function setZipCode(string $zipCode): void
    {
        $zipCode = trim($zipCode);
        $zipCode = str_replace(' ', '', $zipCode);
        $zipCode = strtoupper($zipCode);

        $this->zipCode = $zipCode;
    }

    /**
     * Get the street number.
     *
     * @return int
     */
    public function getStreetNumber(): int
    {
        return $this->streetNumber;
    }

    /**
     * Set the street number.
     *
     * @param int $streetNumber
     */
    public function setStreetNumber(int $streetNumber): void
    {
        $this->streetNumber = $streetNumber;
    }

    /**
     * The url that needs to be requested.
     *
     * @return string
     */
    public function getUrl(): string
    {
        return '/nummeraanduidingen?postcode='.$this->getZipCode().'&huisnummer='.$this->getStreetNumber();
    }

    /**
     * The method that will be used to perform the request.
     *
     * @return string
     */
    public function getMethod(): string
    {
        return 'GET';
    }

    /**
     * The body that will be used to perform the request.
     *
     * @return array|null
     */
    public function getBody(): ?array
    {
        return null;
    }
}
