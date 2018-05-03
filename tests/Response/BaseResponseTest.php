<?php

use AppPackers\Bag\Exception\InvalidApiKeyException;
use AppPackers\Bag\Exception\NotFoundException;
use GuzzleHttp\Psr7\Response;

class BaseResponseTest extends BaseTestCase
{
    public function testNotFoundResponse()
    {
        $response = new Response(404, [], '');

        $this->expectException(NotFoundException::class);

        new MockBaseResponse($response);
    }

    public function test403UnauthorizedResponse()
    {
        $response = new Response(401, [], '');

        $this->expectException(InvalidApiKeyException::class);

        new MockBaseResponse($response);
    }

    public function testForbiddenResponse()
    {
        $response = new Response(403, [], '');

        $this->expectException(InvalidApiKeyException::class);

        new MockBaseResponse($response);
    }
}
