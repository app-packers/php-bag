<?php

use AppPackers\Bag\Exception\NotFoundException;
use AppPackers\Bag\Response\NumberIndicationResponse;
use GuzzleHttp\Psr7\Response;

class NumberingResponseTest extends BaseTestCase
{
    public function testSuccesfulResponse()
    {
        $response = new Response(200, [], '
            {
                "_embedded": {
                    "nummeraanduidingen": [
                        {
                            "identificatiecode": "0200200000007079",
                            "huisnummer": 110,
                            "postcode": "7311KZ",
                            "status": "NaamgevingUitgegeven",
                            "_links": {
                                "self": {
                                    "href": "https://bag.basisregistraties.overheid.nl/api/v1/nummeraanduidingen/0200200000007079?geldigOp=2017-11-20"
                                },
                                "bijbehorendeOpenbareRuimte": {
                                    "href": "https://bag.basisregistraties.overheid.nl/api/v1/openbare-ruimtes/0200300022471548?geldigOp=2017-11-20"
                                },
                                "voorkomens": {
                                    "href": "https://bag.basisregistraties.overheid.nl/api/v1/nummeraanduidingen/0200200000007079/voorkomens?geldigOp=2017-11-20"
                                },
                                "adresseerbaarObject": {
                                    "href": "https://bag.basisregistraties.overheid.nl/api/v1/verblijfsobjecten/0200010000090244"
                                }
                            }
                        }
                    ]
                }
            }
        ');

        $numberingResponse = new NumberIndicationResponse($response);

        $this->assertEquals($numberingResponse->getId(), '0200200000007079');
        $this->assertEquals($numberingResponse->getZipCode(), '7311KZ');
        $this->assertEquals($numberingResponse->getStreetNumber(), '110');
        $this->assertEquals($numberingResponse->getPublicSpaceId(), '0200300022471548');
    }

    public function testNotFoundResponse()
    {
        $response = new Response(200, [], '
            {
                "_embedded": {
                    "nummeraanduidingen": []
                }
            }
        ');

        $this->expectException(NotFoundException::class);

        new NumberIndicationResponse($response);
    }
}
