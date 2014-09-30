<?php

namespace DCS\LikeBundle\Listener;

use DCS\LikeBundle\DCSLikeEvents;
use DCS\LikeBundle\Event\LikeEvent;
use DCS\LikeBundle\Model\LikeManagerInterface;
use DCS\LikeBundle\Model\ThreadManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class LikeEventSubscriber implements EventSubscriberInterface
{
    /**
     * @var LikeManagerInterface
     */
    protected $likeManager;

    /**
     * @var ThreadManagerInterface
     */
    protected $threadManager;

    function __construct(LikeManagerInterface $likeManager, ThreadManagerInterface $threadManager)
    {
        $this->likeManager = $likeManager;
        $this->threadManager = $threadManager;
    }

    public static function getSubscribedEvents()
    {
        return array(
            DCSLikeEvents::LIKE_POST_PERSIST => array('onLikePostPersist'),
            DCSLikeEvents::LIKE_POST_REMOVE => array('onLikePostPersist'),
        );
    }

    public function onLikePostPersist(LikeEvent $event)
    {
        $thread = $this->threadManager->findOneById($event->getLike()->getThread());
        $thread->setNumLikes($this->likeManager->countByThread($thread));

        $this->threadManager->save($thread);
    }
}