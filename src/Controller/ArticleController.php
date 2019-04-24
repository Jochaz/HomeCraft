<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
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

    ///**
    // * @Route("/categorie/{id}", name="categorie_article")
    // */
  /*  public function categorie(CategorieArticle $categorie, CategorieArticleRepository $repo){
        
        //Si c'est une categorie et pas une sous-catégorie
        if (!isNull($categorie.getCategorieArticle())){

        }
        else {
            $categories = $repo->findBy([
                        'Utilisable' => '1',
            //            "CategorieArticle" => NULL
                    ]); 
        }
       // /*$repoPhoto = $this->getDoctrine()->getRepository(PhotoArticleBlog::class);
        $images = array();
        $photoArticle = $repoPhoto->findByIdArticle($article->getId());
        foreach ($photoArticle as $key => $entity) {
            $images[$key] = base64_encode(stream_get_contents($entity->getPhoto()));
      //  }*/

    /*    return $this->render('article/categorie.html.twig', [
            'article' => $article,
            'images' => $images,
        ]);
    }*/
    
}
