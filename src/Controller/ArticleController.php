<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Panier;
use App\Entity\Article;
use App\Entity\PanierArticle;
use App\Entity\CategorieArticle;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\CategorieArticleRepository;
use Doctrine\Common\Persistence\ObjectManager;
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
            'Utilisable' => '0',
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
        dump($categories);
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
            'article' => $article,
        ]);
    }

    /**
     * @Route("/panier", name="panier")
    */
    public function Panier(UserInterface $user){

            $repoPanier = $this->getDoctrine()->getRepository(Panier::class);
            $panier = $repoPanier->findOneBy(['Client' => $user->getId()]);
            return $this->render('article/panier.html.twig', [
                'panier' => $panier,
            ]);
        
        
    }

    /**
     * @Route("/addpanier", name="AjoutPanier")
    */
    public function AddPanier(Request $request, UserInterface $user, ObjectManager $manager){
        $qte = $request->get('qte');
        $idArticle = $request->get('idArticle');
        
        $repoPanier = $this->getDoctrine()->getRepository(Panier::class);
        $panier = $repoPanier->findOneBy(['Client' => $user->getId()]);

        $repoClient = $this->getDoctrine()->getRepository(Client::class);
        $client = $repoClient->find($user->getId());

        $repoArticle = $this->getDoctrine()->getRepository(Article::class);
        $article = $repoArticle->find($idArticle); 

        dump($article);
        
        //On créer le panier avant d'ajouter l'article si il n'existe pas
        if (is_null($panier)){
            $panier = new Panier();

            $panier->setClient($client);
            $panier->setNomPanier('');
            $panier->setCreatedAt(new \DateTime());
            $manager->persist($panier);
            $manager->flush();
        }

        $repoPanierArticle = $this->getDoctrine()->getRepository(PanierArticle::class);
        $panierArticle = $repoPanierArticle->findOneBy(["Panier" => $panier, "Article" => $article]);

        //Si l'article n'est pas dans le panier
        if (is_null($panierArticle)){
            $panierArticle = new PanierArticle();
            $panierArticle->setArticle($article);
            $panierArticle->setPanier($panier);
            $panierArticle->setQuantite($qte);
        } else //Sinon on ajoute la quantité à la quantité existante
        {
            $panierArticle->setQuantite($panierArticle->getQuantite() + $qte);
        }

        $manager->persist($panierArticle);
        $manager->flush();
        
        
        return $this->redirectToRoute('panier');
    }

    /**
     * @Route("/SupprArticlePanier/{id}", name="SupprArticlePanier")
     */
    public function SupprArticlePanier(Article $article, UserInterface $user, ObjectManager $manager){
        $repoPanier = $this->getDoctrine()->getRepository(Panier::class);
        $panier = $repoPanier->findOneBy(['Client' => $user->getId()]);

        $repoPanierArticle = $this->getDoctrine()->getRepository(PanierArticle::class);
        $panierArticle = $repoPanierArticle->findOneBy(["Panier" => $panier, "Article" => $article]);

        $manager->remove($panierArticle);
        $manager->flush();

        return $this->redirectToRoute('panier', [
            'panier' => $panier,
        ]);
    }

    /**
     * @Route("/DeletePanier", name="DeletePanier")
     */
    public function DeletePanier(UserInterface $user, ObjectManager $manager){
        $repoPanier = $this->getDoctrine()->getRepository(Panier::class);
        $panier = $repoPanier->findOneBy(['Client' => $user->getId()]);

        $manager->remove($panier);
        $manager->flush();

        return $this->redirectToRoute('panier', [
            'panier' => $panier,
        ]);
    }
}
