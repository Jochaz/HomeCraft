<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Panier;
use App\Entity\Adresse;
use App\Entity\ModeExpedition;
use App\Entity\ModePaiement;
use App\Entity\Commande;
use App\Entity\Client;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\PanierArticle;
use App\Entity\CommandeArticle;
use App\Entity\StatutCommande;

class CommandeController extends AbstractController
{
    /**
     * @Route("/commande/{id}", name="commande")
     */
    public function index()//Commande $commande)
    {
        return $this->render('commande/index.html.twig', [
            'commande' => $commande
        ]);
    }

    /**
     * @Route("/creationCommande", name="CreationCommande")
     */
    public function creationCommande(UserInterface $user, Request $request, ObjectManager $manager){
        $ModeExpedition = $request->get('selectModeExpedition');
        $ModePaiement = $request->get('selectModePaiement');

        $commande = new Commande();

        $repoClient = $this->getDoctrine()->getRepository(Client::class);
        $client = $repoClient->find($user->getId());

        $repoAdresse = $this->getDoctrine()->getRepository(Adresse::class);
        $adresse = $repoAdresse->findOneBy(['Client' => $user->getId()]);

        $repoModeExpedition = $this->getDoctrine()->getRepository(ModeExpedition::class);
        $modeExpedition = $repoModeExpedition->find($ModeExpedition);

        $repoModePaiement = $this->getDoctrine()->getRepository(ModePaiement::class);
        $modePaiement = $repoModePaiement->find($ModePaiement);

        $repoPanier = $this->getDoctrine()->getRepository(Panier::class);
        $panier = $repoPanier->findOneBy(['Client' => $user->getId()]);

        $repoPanierArticle = $this->getDoctrine()->getRepository(PanierArticle::class);
        $panierArticle = $repoPanierArticle->findBy(["Panier" => $panier]);

        $repoStatutCommande = $this->getDoctrine()->getRepository(StatutCommande::class);
        $statutCommande = $repoStatutCommande->findOneBy(["CodeStatut" => "CR"]);

        $commande->setClient($client);
        $commande->setCreatedAt(new \DateTime());
        $commande->setEstRegle(false);
        $commande->setModeExpedition($modeExpedition);
        $commande->setModePaiement($modePaiement);
        $commande->setAdresseFacturation($adresse);
        $commande->setAdresseLivraison($adresse);
        $commande->setStatutCommande($statutCommande);

        $manager->persist($commande);
        $manager->flush();

        foreach ($panierArticle as $article) {
            $commandeArticle = new CommandeArticle();
            $commandeArticle->setCommande($commande);
            $commandeArticle->setArticle($article->getArticle());
            $commandeArticle->setQuantite($article->getQuantite());

            $manager->persist($commandeArticle);
            $manager->flush();
        }

        foreach ($panierArticle as $article) {
            $manager->remove($article);
            $manager->flush();
        }

        $manager->remove($panier);
        $manager->flush();


        return $this->render('commande/index.html.twig', [
            'commande' => $commande,
            'commandePassee' => True
        ]); 
    }

     /**
     * @Route("/passageCommande", name="PassageCommande")
     */
    public function passageCommande(UserInterface $user)//Commande $commande)
    {
        $repoPanier = $this->getDoctrine()->getRepository(Panier::class);
        $panier = $repoPanier->findOneBy(['Client' => $user->getId()]);

        $repoAdresses = $this->getDoctrine()->getRepository(Adresse::class);
        $adresses = $repoAdresses->findBy(['Client' => $user->getId()]);

        $repoModeExpedition = $this->getDoctrine()->getRepository(ModeExpedition::class);
        $ModeExpedition = $repoModeExpedition->findBy(['PlusActif' => 0]);

        $repoModePaiement = $this->getDoctrine()->getRepository(ModePaiement::class);
        $ModePaiement = $repoModePaiement->findBy(['PlusUtilise' => 0]);

        $repoAdresse = $this->getDoctrine()->getRepository(Adresse::class);
        $Adresse = $repoAdresse->findOneBy(['Client' => $user->getId()]);

        dump($user->getId());
        return $this->render('commande/passageCommande.html.twig', [
            "panier" => $panier,
            "adresses" => $adresses,
            "modesExpedition" => $ModeExpedition,
            "modesPaiement" => $ModePaiement,
            "Adresse" => $Adresse,
        ]);
    }


}
