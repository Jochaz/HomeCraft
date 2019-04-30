<?php

namespace App\Controller;

use App\Entity\ArticleBlog;
use App\Entity\PhotoArticle;
use App\Entity\PhotoArticleBlog;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpKernel\Client;
use App\Repository\ArticleBlogRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SiteController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(ArticleBlogRepository $repoBlog, ArticleRepository $repoArticle)
    {
        
        $articlesBlog = $repoBlog->findLastCreatedArticle();
        $articleBlog = $articlesBlog[0];

        $articles = $repoArticle->findLastCreatedArticle();
        $article = $articles[0];

        return $this->render('site/home.html.twig', [
            "articleBlog" => $articleBlog,
            "article" => $article,
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