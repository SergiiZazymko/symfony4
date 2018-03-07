<?php

namespace App\Repository;

use App\Entity\HappyMessage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method HappyMessage|null find($id, $lockMode = null, $lockVersion = null)
 * @method HappyMessage|null findOneBy(array $criteria, array $orderBy = null)
 * @method HappyMessage[]    findAll()
 * @method HappyMessage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HappyMessageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, HappyMessage::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('h')
            ->where('h.something = :value')->setParameter('value', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
