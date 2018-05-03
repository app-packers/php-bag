<?php

use AppPackers\Bag\Request\NumberIndicationRequest;

class NumberIndicationRequestTest extends BaseTestCase
{
    public function testProperlyFormattedZipCode()
    {
        $numberingRequest = new NumberIndicationRequest();

        $numberingRequest->setZipCode(' 7311KZ ');
        $this->assertEquals($numberingRequest->getZipCode(), '7311KZ');

        $numberingRequest->setZipCode('7311 KZ');
        $this->assertEquals($numberingRequest->getZipCode(), '7311KZ');

        $numberingRequest->setZipCode('7311kz');
        $this->assertEquals($numberingRequest->getZipCode(), '7311KZ');
    }

    public function testProperlyFormattedStreetNumber()
    {
        $numberingRequest = new NumberIndicationRequest();

        $numberingRequest->setStreetNumber(110);
        $this->assertEquals($numberingRequest->getStreetNumber(), 110);
    }

    public function testBuildRequestByZipcodeAndStreetNumber()
    {
        $zipCode = '7311KZ';
        $streetNumber = 110;

        $numberIndicationRequest = new NumberIndicationRequest();
        $numberIndicationRequest->setZipCode($zipCode);
        $numberIndicationRequest->setStreetNumber($streetNumber);

        $this->assertEquals($numberIndicationRequest->getUrl(), '/nummeraanduidingen?postcode='.$zipCode.'&huisnummer='.$streetNumber);
        $this->assertEquals($numberIndicationRequest->getMethod(), 'GET');
        $this->assertEquals((string) $numberIndicationRequest->getBody(), '');
    }
}
