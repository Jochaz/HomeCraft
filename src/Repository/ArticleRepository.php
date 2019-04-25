<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Article::class);
    }

    // /**
    //  * @return Article[] Returns an array of Article objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
    public function findLastCreatedArticle() {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery('SELECT ab 
                                              FROM App\Entity\Article ab 
                                              WHERE ab.createdAt=(SELECT MAX(abb.createdAt) 
                                                                  FROM App\Entity\Article abb
                                                                  WHERE abb.EnVente = 1)
                                              ORDER BY ab.id DESC')
                                ->setMaxResults(1);
                        
        return $query->execute();
    }
    
    public function findListeArticleByCategorieId($value) {
        $entityManager = $this->getEntityManager();
        $rsm = new ResultSetMapping;
        $rsm->addEntityResult('App\Entity\Article', 'a');
        $rsm->addFieldResult('a', 'id', 'id');
        $rsm->addFieldResult('a', 'NomArticle', 'NomArticle');
        $rsm->addFieldResult('a', 'DescriptionArticle', 'DescriptionArticle');

        $query = $entityManager->createNativeQuery('SELECT *
                                                    FROM article a
                                                    INNER JOIN article_categorie_article ON article_categorie_article.id_article = a.id 
                                                    WHERE a.en_vente = 1
                                                    AND article_categorie_article.categorie_article_id = '.$value, $rsm);                        
        return $query->execute();
    }

    /*
    public function findOneBySomeField($value): ?Article
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
