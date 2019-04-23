<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ArticleBlog;
use App\Repository\ArticleBlogRepository;
use App\Entity\PhotoArticleBlog;
use Symfony\Component\HttpKernel\Client;

class SiteController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(ArticleBlogRepository $repo)
    {
        
        $articles = $repo->findLastCreatedArticle();
        $article = $articles[0];

        $repoPhoto = $this->getDoctrine()->getRepository(PhotoArticleBlog::class);
        $images = array();
        $photoArticle = $repoPhoto->findByIdArticle($article->getId());
        foreach ($photoArticle as $key => $entity) {
            $images[$key] = base64_encode(stream_get_contents($entity->getPhoto()));
        }
        return $this->render('site/home.html.twig', [
            "article" => $article,
            "images" => $images
        ]);
    }
    
    /**
     * @Route("/blog", name="blog")
     */
    public function blog(ArticleBlogRepository $repo)
    {
        $articles = $repo->findAll();
        return $this->render('site/blog.html.twig', [
            'controller_name' => 'SiteController',
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/blog/{id}", name="article_blog")
     */
    public function show(ArticleBlog $article){
        $repoPhoto = $this->getDoctrine()->getRepository(PhotoArticleBlog::class);
        $images = array();
        $photoArticle = $repoPhoto->findByIdArticle($article->getId());
        foreach ($photoArticle as $key => $entity) {
            $images[$key] = base64_encode(stream_get_contents($entity->getPhoto()));
        }

        return $this->render('site/articleblog.html.twig', [
            'article' => $article,
            'images' => $images,
        ]);
    }

    /**
     * @Route("/compte", name="compte")
     */
    public function compte(){
        return $this->render('site/compte.html.twig', [
            'client' => $this->getUser()
        ]);
    }
}