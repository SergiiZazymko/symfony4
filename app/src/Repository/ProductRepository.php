<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }


    public function findByCategory($value)
    {
        return $this->createQueryBuilder('p')
            ->where('p.category = :value')->setParameter('value', $value)
            ->orderBy('p.updatedAt', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findImages()
    {
        return $this->createQueryBuilder('p')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findAllDesk()
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.updatedAt', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

}
