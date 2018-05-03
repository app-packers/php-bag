<?php

namespace AppPackers\Bag\Response;

use AppPackers\Bag\Exception\NumberIndicatioNotFoundException;

/**
 * Class NumberIndicationResponse.
 */
class NumberIndicationResponse extends BaseResponse
{
    /**
     * The id of the number indication.
     *
     * @var string
     */
    private $id;

    /**
     * The zip of the number indication.
     *
     * @var string
     */
    private $zipCode;

    /**
     * The zip of the number indication.
     *
     * @var int
     */
    private $streetNumber;

    /**
     * The id of the public space.
     *
     * @var string
     */
    private $publicSpaceId;

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
    private function setZipCode(string $zipCode): void
    {
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
    private function setStreetNumber(int $streetNumber): void
    {
        $this->streetNumber = $streetNumber;
    }

    /**
     * Get the public space id.
     *
     * @return string
     */
    public function getPublicSpaceId(): string
    {
        return $this->publicSpaceId;
    }

    /**
     * Set public space identification by public space url.
     *
     * @param string $publicSpaceUrl
     */
    private function setPublicSpaceId(string $publicSpaceUrl): void
    {
        preg_match('/\/([0-9]*)\?/', $publicSpaceUrl, $matches);

        $this->publicSpaceId = (string) $matches[1];
    }

    /**
     * Parse the response.
     */
    protected function parse()
    {
        $json = json_decode($this->getResponse()->getBody(), true);

        if (count($json['_embedded']['nummeraanduidingen']) == 1) {
            $numbering = $json['_embedded']['nummeraanduidingen'][0];

            $this->setId($numbering['identificatiecode']);

            $this->setZipCode($numbering['postcode']);
            $this->setStreetNumber($numbering['huisnummer']);

            $this->setPublicSpaceId($numbering['_links']['bijbehorendeOpenbareRuimte']['href']);
        } else {
            throw new NumberIndicatioNotFoundException();
        }
    }
}
