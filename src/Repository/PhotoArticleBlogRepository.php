<?php

namespace App\Repository;

use App\Entity\PhotoArticleBlog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PhotoArticleBlog|null find($id, $lockMode = null, $lockVersion = null)
 * @method PhotoArticleBlog|null findOneBy(array $criteria, array $orderBy = null)
 * @method PhotoArticleBlog[]    findAll()
 * @method PhotoArticleBlog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhotoArticleBlogRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PhotoArticleBlog::class);
    }

    // /**
    //  * @return PhotoArticleBlog[] Returns an array of PhotoArticleBlog objects
    //  */
    
    public function findByIdArticle($value)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\PhotoArticleBlog p
            WHERE p.id = :value
            ORDER BY p.id ASC'
        )->setParameter('value', $value);
    
        // returns an array of Product objects
        return $query->execute();
    }
    

    /*
    public function findOneBySomeField($value): ?PhotoArticleBlog
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
