<?php

use AppPackers\Bag\Response\PublicSpaceResponse;
use GuzzleHttp\Psr7\Response;

class PublicSpaceResponseTest extends BaseTestCase
{
    public function testSuccessfulResponse()
    {
        $response = new Response(200, [], '
            {
                "identificatiecode": "0200300022471548",
                "naam": "Hofstraat",
                "status": "NaamgevingUitgegeven",
                "_links": {
                    "self": {
                        "href": "https://bag.basisregistraties.overheid.nl/api/v1/openbare-ruimtes/0200300022471548?geldigOp=2017-11-20"
                    },
                    "bijbehorendeWoonplaats": {
                        "href": "https://bag.basisregistraties.overheid.nl/api/v1/woonplaatsen/3560?geldigOp=2017-11-20"
                    },
                    "voorkomens": {
                        "href": "https://bag.basisregistraties.overheid.nl/api/v1/openbare-ruimtes/0200300022471548/voorkomens?geldigOp=2017-11-20"
                    }
                }
            }     
        ');

        $publicSpaceResponse = new PublicSpaceResponse($response);

        $this->assertEquals($publicSpaceResponse->getId(), '0200300022471548');
        $this->assertEquals($publicSpaceResponse->getStreet(), 'Hofstraat');
        $this->assertEquals($publicSpaceResponse->getCityId(), '3560');
    }
}
