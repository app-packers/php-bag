<?php

use AppPackers\Bag\Response\CityResponse;
use GuzzleHttp\Psr7\Response;

class CityResponseTest extends BaseTestCase
{
    public function testSuccessfulResponse()
    {
        $response = new Response(200, [], '
            {
                "identificatiecode": "3560",
                "naam": "Apeldoorn",
                "status": "WoonplaatsAangewezen",
                "_links": {
                    "self": {
                        "href": "https://bag.basisregistraties.overheid.nl/api/v1/woonplaatsen/3560?geldigOp=2017-11-20"
                    },
                    "voorkomens": {
                        "href": "https://bag.basisregistraties.overheid.nl/api/v1/woonplaatsen/3560/voorkomens?geldigOp=2017-11-20"
                    }
                }
            }  
        ');

        $cityResponse = new CityResponse($response);

        $this->assertEquals($cityResponse->getId(), '3560');
        $this->assertEquals($cityResponse->getCity(), 'Apeldoorn');
    }
}
