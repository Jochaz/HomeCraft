<?php

namespace App\Repository;

use App\Entity\TypeAdresse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeAdresse|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeAdresse|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeAdresse[]    findAll()
 * @method TypeAdresse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeAdresseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeAdresse::class);
    }

    // /**
    //  * @return TypeAdresse[] Returns an array of TypeAdresse objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeAdresse
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
