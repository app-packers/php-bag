<?php

namespace AppPackers\Bag\Request;

/**
 * Interface BaseRequest.
 */
interface BaseRequest
{
    /**
     * The url that needs to be requested.
     *
     * @return string
     */
    public function getUrl(): string;

    /**
     * The method that will be used to perform the request.
     *
     * @return string
     */
    public function getMethod(): string;

    /**
     * The body that will be used to perform the request.
     *
     * @return array|null
     */
    public function getBody(): ?array;
}
