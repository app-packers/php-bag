<?php

use AppPackers\Bag\BagClient;
use AppPackers\Bag\Exception\InvalidApiKeyException;
use AppPackers\Bag\Exception\NotFoundException;
use PHPUnit\Framework\TestCase;

class BagClientTest extends TestCase
{
    /**
     * @var BagClient
     */
    private $bagClient;

    protected function setUp()
    {
        parent::setUp();

        $this->bagClient = new BagClient();
        $this->bagClient->setApiKey(getenv('API_KEY'));
    }

    public function testApiBaseUrlShouldBeSet()
    {
        $apiBaseUrl = 'https://www.google.com';

        $this->bagClient->setApiBaseUrl($apiBaseUrl);

        $this->assertEquals($this->bagClient->getApiBaseUrl(), $apiBaseUrl);
    }

    public function testApiBaseUrlShouldBeFormatted()
    {
        $this->bagClient->setApiBaseUrl('https://www.google.com/');

        $this->assertEquals($this->bagClient->getApiBaseUrl(), 'https://www.google.com');
    }

    public function testApiKeyShouldBeSet()
    {
        $apiKey = '00000000-0000-0000-0000-000000000000';

        $this->bagClient->setApiKey($apiKey);

        $this->assertEquals($this->bagClient->getApiKey(), $apiKey);
    }

    public function testAnInvalidApiKeyShouldThrowInvalidApiKeyException()
    {
        $this->expectException(InvalidApiKeyException::class);

        $this->bagClient->setApiKey('INVALID_KEY');
    }

    public function testSuccessfullyRetrievedAddress()
    {
        $address = $this->bagClient->getAddressByZipcodeAndStreetNumber('7311KZ', 110);

        $this->assertEquals($address->getStreet(), 'Hofstraat');
        $this->assertEquals($address->getStreetNumber(), 110);
        $this->assertEquals($address->getZipCode(), '7311KZ');
        $this->assertEquals($address->getCity(), 'Apeldoorn');
    }

    public function testShouldThrowNotFoundExceptionWhenZipcodeAndStreetNumberAreInvalid()
    {
        $this->expectException(NotFoundException::class);

        $this->bagClient->getAddressByZipcodeAndStreetNumber('1234AB', 1);
    }
}
