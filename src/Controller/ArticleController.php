<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Entity\CategorieArticle;
use App\Entity\PhotoCategorie;
use App\Repository\CategorieArticleRepository;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article/{id}", name="article")
     */
    public function index(Article $article)
    {
        return $this->render('article/index.html.twig', [
            'article' => $article,
        ]);
    }
    
    /**
     * @Route("/catalogue", name="catalogue")
     */
    public function catalogue(CategorieArticleRepository $repo)
    {
        $categories = $repo->findBy([
            'Utilisable' => '1',
            "CategorieArticle" => NULL
        ]); 

        return $this->render('article/catalogue.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/categorie/{id}", name="categorie_article")
    */
    public function categorie(CategorieArticleRepository $repo, CategorieArticle $categorie){
        
        //Si c'est une categorie et pas une sous-catégorie
        $categories = $repo->findBy([
                    'Utilisable' => '1',
                    "CategorieArticle" => $categorie->getId()
                ]); 

        return $this->render('article/categorie.html.twig', [
            'categories' => $categories,
            'parentCategorieNom' => $categorie->getNom()
        ]);
    }
    
}
