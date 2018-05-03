<?php

use AppPackers\Bag\Request\PublicSpaceRequest;

class PublicSpaceRequestTest extends BaseTestCase
{
    public function testProperlyFormattedIdentifier()
    {
        $publicSpaceRequest = new PublicSpaceRequest();

        $publicSpaceRequest->setId(' 1234 ');
        $this->assertEquals($publicSpaceRequest->getId(), '1234');

        $publicSpaceRequest->setId('12 34');
        $this->assertEquals($publicSpaceRequest->getId(), '1234');
    }

    public function testBuildRequestByIdentifier()
    {
        $id = '1234';

        $publicSpaceRequest = new PublicSpaceRequest();
        $publicSpaceRequest->setId($id);

        $this->assertEquals($publicSpaceRequest->getUrl(), '/openbare-ruimtes/'.$id);
        $this->assertEquals($publicSpaceRequest->getMethod(), 'GET');
        $this->assertEquals((string) $publicSpaceRequest->getBody(), '');
    }
}
