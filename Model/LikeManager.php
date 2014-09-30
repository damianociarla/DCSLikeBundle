<?php

namespace DCS\LikeBundle\Model;

use DCS\LikeBundle\DCSLikeEvents;
use DCS\LikeBundle\Event\LikeEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\User\UserInterface;

abstract class LikeManager implements LikeManagerInterface
{
    /**
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * {@inheritdoc}
     */
    public function create(ThreadInterface $thread)
    {
        $class = $this->getClass();

        $like = new $class();
        $like->setThread($thread);

        return $like;
    }

    /**
     * {@inheritdoc}
     */
    public function save(LikeInterface $like)
    {
        $this->dispatcher->dispatch(DCSLikeEvents::LIKE_PRE_PERSIST, new LikeEvent($like));

        $this->doSaveLike($like);

        $this->dispatcher->dispatch(DCSLikeEvents::LIKE_POST_PERSIST, new LikeEvent($like));
    }

    /**
     * {@inheritdoc}
     */
    public function remove(LikeInterface $like)
    {
        $this->dispatcher->dispatch(DCSLikeEvents::LIKE_PRE_REMOVE, new LikeEvent($like));

        $this->doRemoveLike($like);

        $this->dispatcher->dispatch(DCSLikeEvents::LIKE_POST_REMOVE, new LikeEvent($like));
    }

    /**
     * Finds one like Thread and User
     *
     * @param ThreadInterface $thread
     * @param UserInterface $user
     * @return LikeInterface|null
     */
    public function findOneByThreadAndUser(ThreadInterface $thread, UserInterface $user)
    {
        return $this->findOneBy(array(
            'thread' => $thread,
            'user' => $user,
        ));
    }

    /**
     * Performs the persistence of the Like
     *
     * @param LikeInterface $like
     * @return void
     */
    abstract protected function doSaveLike(LikeInterface $like);

    /**
     * Performs the removing of the Like
     *
     * @param LikeInterface $like
     * @return void
     */
    abstract protected function doRemoveLike(LikeInterface $like);
} 