<?php

use AppPackers\Bag\Request\CityRequest;

class CityRequestTest extends BaseTestCase
{
    public function testProperlyFormattedIdentifier()
    {
        $cityRequest = new CityRequest();

        $cityRequest->setId(' 1234 ');
        $this->assertEquals($cityRequest->getId(), '1234');

        $cityRequest->setId('12 34');
        $this->assertEquals($cityRequest->getId(), '1234');
    }

    public function testBuildRequestByIdentifier()
    {
        $id = '1234';

        $cityRequest = new CityRequest();
        $cityRequest->setId($id);

        $this->assertEquals($cityRequest->getUrl(), '/woonplaatsen/'.$id);
        $this->assertEquals($cityRequest->getMethod(), 'GET');
        $this->assertEquals((string) $cityRequest->getBody(), '');
    }
}
