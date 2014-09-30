<?php

namespace DCS\LikeBundle\Model;

interface ThreadManagerInterface
{
    /**
     * Returns the thread fully qualified class name
     *
     * @return string
     */
    public function getClass();

    /**
     * Create new thread instance
     *
     * @param mixed $id
     * @return ThreadInterface
     */
    public function create($id = null);

    /**
     * Save a thread
     *
     * @param ThreadInterface $thread
     * @return void
     */
    public function save(ThreadInterface $thread);

    /**
     * Update a thread
     *
     * @param ThreadInterface $thread
     * @return void
     */
    public function patch(ThreadInterface $thread);

    /**
     * Finds one thread by id
     *
     * @param mixed $id
     * @return ThreadInterface|null
     */
    public function findOneById($id);

    /**
     * Finds one thread by the given criteria
     *
     * @param array $criteria
     * @return ThreadInterface|null
     */
    public function findOneBy(array $criteria);
}