<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Article;
use App\Entity\Commande;
use App\Form\ClientType;
use App\Entity\ArticleBlog;
use App\Form\InscriptionType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdministrationController extends AbstractController
{
    /**
     * @Route("/administration", name="administration")
     */
    public function index()
    {
        return $this->render('administration/index.html.twig', [
            'controller_name' => 'AdministrationController',
        ]);
    }
    
    /**
     * @Route("administration/clients", name="clients")
     */
    public function clients()
    {
        $repoClient = $this->getDoctrine()->getRepository(Client::class);
        $clients = $repoClient->findAll();    


        return $this->render('administration/listeclient.html.twig', [
            'clients' => $clients
        ]);
    }

    /**
     * @Route("/administration/client/{id}", name="AdminClient")
     */
    public function client(Client $client)
    {
        $form = $this->createForm(ClientType::class, $client);
        
        return $this->render('administration/client.html.twig', [
            'form' => $form->createView(),
            'client' => $client
        ]);
    }
        
    /**
     * @Route("administration/listecommande", name="listecommande")
     */
    public function commandes()
    {
        $repoCommande = $this->getDoctrine()->getRepository(Commande::class);
        $commandes = $repoCommande->findAll();    

        return $this->render('administration/listescommande.html.twig', [
            'commandes' => $commandes,
        ]);
    }

    /**
     * @Route("administration/blogs", name="blogs")
     */
    public function blogs()
    {
        $repoBlog = $this->getDoctrine()->getRepository(ArticleBlog::class);
        $blogs = $repoBlog->findAll();  
        return $this->render('administration/listeblog.html.twig', [
            'blogs' => $blogs
        ]);
    }

    /**
     * @Route("administration/articles", name="articles")
     */
    public function articles()
    {
        $repoArticle = $this->getDoctrine()->getRepository(Article::class);
        $articles = $repoArticle->findAll(); 
        return $this->render('administration/listearticle.html.twig', [
            'articles' => $articles
        ]);
    }
}
