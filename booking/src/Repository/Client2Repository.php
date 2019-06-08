<?php

namespace App\Repository;

use App\Entity\Client2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Client2|null find($id, $lockMode = null, $lockVersion = null)
 * @method Client2|null findOneBy(array $criteria, array $orderBy = null)
 * @method Client2[]    findAll()
 * @method Client2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Client2Repository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Client2::class);
    }

    // /**
    //  * @return Client2[] Returns an array of Client2 objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Client2
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
