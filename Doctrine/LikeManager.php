<?php

namespace DCS\LikeBundle\Doctrine;

use DCS\LikeBundle\Model\LikeInterface;
use DCS\LikeBundle\Model\LikeManager as BaseLikeManager;
use DCS\LikeBundle\Model\ThreadInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class LikeManager extends BaseLikeManager
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var EntityRepository
     */
    protected $repository;

    /**
     * @var string
     */
    protected $class;

    function __construct(EventDispatcherInterface $dispatcher, EntityManager $em, $class)
    {
        parent::__construct($dispatcher);

        $this->em = $em;
        $this->class = $class;
        $this->repository = $em->getRepository($class);
    }

    /**
     * {@inheritdoc}
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * {@inheritdoc}
     */
    protected function doSaveLike(LikeInterface $like)
    {
        $this->em->persist($like);
        $this->em->flush();
    }

    /**
     * {@inheritdoc}
     */
    protected function doRemoveLike(LikeInterface $like)
    {
        $this->em->remove($like);
        $this->em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function countByThread(ThreadInterface $thread)
    {
        return $this->em
            ->createQueryBuilder()
            ->select('COUNT(DISTINCT l)')
            ->from($this->class, 'l')
            ->where('l.thread = :thread')
            ->setParameter(':thread', $thread)
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findOneBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }
}