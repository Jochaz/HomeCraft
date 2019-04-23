<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
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
        $categories = $repo->findAll(); 
        return $this->render('article/catalogue.html.twig', [
            'categories' => $categories,
        ]);
    }
}
