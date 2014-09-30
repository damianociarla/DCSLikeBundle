<?php

namespace DCS\LikeBundle\Model;

interface LikeInterface
{
    /**
     * Get id
     *
     * @return mixed
     */
    public function getId();

    /**
     * Get thread
     *
     * @return ThreadInterface
     */
    public function getThread();

    /**
     * Set thread
     *
     * @param ThreadInterface $thread
     * @return LikeInterface
     */
    public function setThread($thread);

    /**
     * Get user
     *
     * @return UserInterface
     */
    public function getUser();

    /**
     * Set user
     *
     * @param UserInterface $user
     * @return LikeInterface
     */
    public function setUser($user);

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return LikeInterface
     */
    public function setCreatedAt($createdAt);
} 