<?php

namespace AppPackers\Bag\Request;

/**
 * Class PublicSpaceRequest.
 */
class PublicSpaceRequest implements BaseRequest
{
    /**
     * The id of the public space.
     *
     * @var string
     */
    private $id;

    /**
     * Get the id.
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set the id.
     *
     * @param string $id
     */
    public function setId(string $id): void
    {
        $id = trim($id);
        $id = str_replace(' ', '', $id);

        $this->id = $id;
    }

    /**
     * The url that needs to be requested.
     *
     * @return string
     */
    public function getUrl(): string
    {
        return '/openbare-ruimtes/'.$this->getId();
    }

    /**
     * The method that will be used to perform the request.
     *
     * @return string
     */
    public function getMethod(): string
    {
        return 'GET';
    }

    /**
     * The body that will be used to perform the request.
     *
     * @return array|null
     */
    public function getBody(): ?array
    {
        return null;
    }
}
