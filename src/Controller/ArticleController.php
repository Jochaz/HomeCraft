<?php

namespace App\Controller;

use App\Entity\Panier;
use App\Entity\Article;
use Psr\Log\LoggerInterface;
use App\Entity\PhotoCategorie;
use App\Entity\CategorieArticle;
use App\Repository\ArticleRepository;
use App\Repository\CategorieArticleRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


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

    /**
     * @Route("/categorie/{id}/article", name="categorie_article_listing")
    */
    public function listingArticle(ArticleRepository $repo, CategorieArticle $categorie){
        
        //Si c'est une categorie et pas une sous-catégorie
        $articles = $repo->findBy([
            'EnVente' => 1
        ]);         
        return $this->render('article/listearticle.html.twig', [
            'articles' => $articles,
            'idCategorie' => $categorie->getId()
        ]);
    }
    
    /**
     * @Route("/article/{id}", name="article")
    */
    public function Article(Article $article){
        return $this->render('article/article.html.twig', [
            'article' => $article
        ]);
    }

    /**
     * @Route("/panier", name="panier")
    */
    public function Panier(UserInterface $user){

            $repoPanier = $this->getDoctrine()->getRepository(Panier::class);
            $panier = $repoPanier->findOneBy(['Client' => $user->getId()]);

            return $this->render('article/panier.html.twig', [
                'panier' => $panier
            ]);
        
        
    }
}
