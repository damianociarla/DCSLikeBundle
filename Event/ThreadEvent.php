<?php

namespace DCS\LikeBundle\Event;

use DCS\LikeBundle\Model\ThreadInterface;
use Symfony\Component\EventDispatcher\Event;

class ThreadEvent extends Event
{
    /**
     * @var ThreadInterface
     */
    private $thread;

    function __construct(ThreadInterface $thread)
    {
        $this->thread = $thread;
    }

    /**
     * Get thread
     *
     * @return ThreadInterface
     */
    public function getThread()
    {
        return $this->thread;
    }
} 