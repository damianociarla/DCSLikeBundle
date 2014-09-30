<?php

namespace DCS\LikeBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;

abstract class Like implements LikeInterface
{
    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var ThreadInterface
     */
    protected $thread;

    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getThread()
    {
        return $this->thread;
    }

    /**
     * {@inheritdoc}
     */
    public function setThread($thread)
    {
        $this->thread = $thread;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * {@inheritdoc}
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}