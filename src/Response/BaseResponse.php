<?php

namespace AppPackers\Bag\Response;

use AppPackers\Bag\Exception\InvalidApiKeyException;
use AppPackers\Bag\Exception\NotFoundException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class BaseResponse.
 */
abstract class BaseResponse
{
    /**
     * The response.
     *
     * @var ResponseInterface
     */
    protected $response;

    /**
     * BaseResponse constructor.
     *
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->setResponse($response);

        if ($this->isSuccessful()) {
            $this->parse();
        }
    }

    /**
     * Get the response.
     *
     * @return ResponseInterface
     */
    protected function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    /**
     * Set the response.
     *
     * @param ResponseInterface $response
     */
    private function setResponse(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * Determine if request is successful.
     *
     * @return bool
     */
    private function isSuccessful(): bool
    {
        $statusCode = $this->response->getStatusCode();

        switch ($statusCode) {
            case 403:
            case 401:
                throw new InvalidApiKeyException();
            case 404:
                throw new NotFoundException();
        }

        return true;
    }

    /**
     * Parse the response.
     */
    abstract protected function parse();
}
