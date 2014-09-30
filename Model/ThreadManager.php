<?php

namespace DCS\LikeBundle\Model;

use DCS\LikeBundle\DCSLikeEvents;
use DCS\LikeBundle\Event\ThreadEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

abstract class ThreadManager implements ThreadManagerInterface
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
    public function create($id = null)
    {
        $class = $this->getClass();
        $thread = new $class();

        if (null !== $id) {
            $thread->setId($id);
        }

        return $thread;
    }

    /**
     * {@inheritdoc}
     */
    public function findOneById($id)
    {
        return $this->findOneBy(array('id' => $id));
    }

    /**
     * {@inheritdoc}
     */
    public function save(ThreadInterface $thread)
    {
        $this->dispatcher->dispatch(DCSLikeEvents::THREAD_PRE_PERSIST, new ThreadEvent($thread));

        $this->doSaveThread($thread);

        $this->dispatcher->dispatch(DCSLikeEvents::THREAD_POST_PERSIST, new ThreadEvent($thread));
    }

    /**
     * {@inheritdoc}
     */
    public function patch(ThreadInterface $thread)
    {
        $this->doSaveThread($thread);
    }

    /**
     * Performs the persistence of the Thread
     *
     * @param ThreadInterface $thread
     * @return void
     */
    abstract protected function doSaveThread(ThreadInterface $thread);
}