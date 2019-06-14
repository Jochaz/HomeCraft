<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Article;
use App\Entity\Commande;
use App\Form\ClientType;
use App\Entity\ArticleBlog;
use App\Form\InscriptionType;
use App\Entity\StatutCommande;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
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


        return $this->render('administration/client/listeclient.html.twig', [
            'clients' => $clients
        ]);
    }

    /**
     * @Route("/administration/client/{id}", name="AdminClient")
     */
    public function client(Client $client)
    {
        $form = $this->createForm(ClientType::class, $client);
        
        return $this->render('administration/client/client.html.twig', [
            'form' => $form->createView(),
            'client' => $client
        ]);
    }

    /**
     * @Route("administration/listecommande/client/{id}", name="listecommandeclient")
     */
    public function commandeClient(Client $client)
    {
        $repoCommande = $this->getDoctrine()->getRepository(Commande::class);
        $commandes = $repoCommande->findBy(["Client" => $client]);    
        return $this->render('/administration/commande/listecommandeclient.html.twig', [
            'commandes' => $commandes,
            'client' => $client
        ]);
    }
        
    /**
     * @Route("/administration/listecommande", name="listecommande")
     */
    public function commandes()
    {
        $repoCommande = $this->getDoctrine()->getRepository(Commande::class);
        $commandes = $repoCommande->findAll();    

        return $this->render('administration/commande/listescommande.html.twig', [
            'commandes' => $commandes,
        ]);
    }

    /**
     * @Route("/administration/commande/{id}", name="admincommande")
     */
    public function commande(Commande $commande)
    {
        $repoStatut = $this->getDoctrine()->getRepository(StatutCommande::class);
        $statuts = $repoStatut->findAll(); 

        return $this->render('administration/commande/commande.html.twig', [
            'commande' => $commande,
            'statuts' => $statuts
        ]);
    }

    /**
     * @Route("/administration/AdminModificationCommande", name="adminModifCommande")
     */
    public function modificationCommande(Request $request, ObjectManager $manager){
        $repoCommande = $this->getDoctrine()->getRepository(Commande::class);
        $commande = $repoCommande->findOneById($request->get('commande'));

        $repoStatut = $this->getDoctrine()->getRepository(StatutCommande::class);
        $statut = $repoStatut->findOneById($request->get('select_statut_commande'));
        $statuts = $repoStatut->findAll(); 
        $modif = False;

        if ($commande->getEstRegle() == false && $request->get('select_reglement_commande') == "1"){
            $commande->setEstRegle(True);
            $modif = TRUE;    
        }
        if ($commande->getStatutCommande() != $statut){
            $commande->setStatutCommande($statut);
            $modif = TRUE;  
        }
        if ($modif){
            $manager->persist($commande);
            $manager->flush();
        }
        
        return $this->redirectToRoute('admincommande', array(
            'id' => $commande->getId()
        ));
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
