<?php

namespace DCS\LikeBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;

interface LikeManagerInterface
{
    /**
     * Returns the like fully qualified class name
     *
     * @return string
     */
    public function getClass();

    /**
     * Create new like instance
     *
     * @param ThreadInterface $thread
     * @return LikeInterface
     */
    public function create(ThreadInterface $thread);

    /**
     * Save a like
     *
     * @param LikeInterface $like
     * @return void
     */
    public function save(LikeInterface $like);

    /**
     * Remove a like
     *
     * @param LikeInterface $like
     * @return void
     */
    public function remove(LikeInterface $like);

    /**
     * Count like for un Thread
     *
     * @param ThreadInterface $thread
     * @return int
     */
    public function countByThread(ThreadInterface $thread);

    /**
     * Finds one like Thread and User
     *
     * @param ThreadInterface $thread
     * @param UserInterface $user
     * @return LikeInterface|null
     */
    public function findOneByThreadAndUser(ThreadInterface $thread, UserInterface $user);

    /**
     * Finds one like by the given criteria
     *
     * @param array $criteria
     * @return LikeInterface
     */
    public function findOneBy(array $criteria);
}