<?php

namespace DCS\LikeBundle\Model;

interface ThreadInterface
{
    /**
     * Set id
     *
     * @param string $id
     * @return ThreadInterface
     */
    public function setId($id);

    /**
     * Get lastLikeAt
     *
     * @return \DateTime
     */
    public function getLastLikeAt();

    /**
     * Set lastLikeAt
     *
     * @param \DateTime $lastLikeAt
     * @return ThreadInterface
     */
    public function setLastLikeAt($lastLikeAt);

    /**
     * Get numLikes
     *
     * @return int
     */
    public function getNumLikes();

    /**
     * Set numLikes
     *
     * @param int $numLikes
     * @return ThreadInterface
     */
    public function setNumLikes($numLikes);

    /**
     * Get permalink
     *
     * @return string
     */
    public function getPermalink();

    /**
     * Set permalink
     *
     * @param string $permalink
     * @return ThreadInterface
     */
    public function setPermalink($permalink);
} 