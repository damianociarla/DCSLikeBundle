<?php

namespace DCS\LikeBundle\Event;

use Symfony\Component\HttpFoundation\Response;

class ThreadResponseEvent extends ThreadEvent
{
    private $response;

    /**
     * Get response
     *
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Set response
     *
     * @param Response $response
     * @return ThreadResponseEvent
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;
        return $this;
    }
}