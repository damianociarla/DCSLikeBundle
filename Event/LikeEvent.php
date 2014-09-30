<?php

namespace DCS\LikeBundle\Event;

use DCS\LikeBundle\Model\LikeInterface;
use Symfony\Component\EventDispatcher\Event;

class LikeEvent extends Event
{
    /**
     * @var LikeInterface
     */
    private $thread;

    function __construct(LikeInterface $thread)
    {
        $this->thread = $thread;
    }

    /**
     * Get thread
     *
     * @return LikeInterface
     */
    public function getLike()
    {
        return $this->thread;
    }
} 