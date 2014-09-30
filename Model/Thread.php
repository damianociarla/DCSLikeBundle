<?php

namespace DCS\LikeBundle\Model;

abstract class Thread implements ThreadInterface
{
    /**
     * Id, a unique string that binds the likes together in a thread.
     * It can be a url or really anything unique.
     *
     * @var string
     */
    protected $id;

    /**
     * Denormalized number of likes
     *
     * @var integer
     */
    protected $numLikes;

    /**
     * Denormalized date of the last like
     *
     * @var \DateTime
     */
    protected $lastLikeAt;

    /**
     * Url of the page where the thread lives
     *
     * @var string
     */
    protected $permalink;

    function __construct()
    {
        $this->numLikes = 0;
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getLastLikeAt()
    {
        return $this->lastLikeAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setLastLikeAt($lastLikeAt)
    {
        $this->lastLikeAt = $lastLikeAt;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getNumLikes()
    {
        return $this->numLikes;
    }

    /**
     * {@inheritdoc}
     */
    public function setNumLikes($numLikes)
    {
        $this->numLikes = $numLikes;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPermalink()
    {
        return $this->permalink;
    }

    /**
     * {@inheritdoc}
     */
    public function setPermalink($permalink)
    {
        $this->permalink = $permalink;

        return $this;
    }
}