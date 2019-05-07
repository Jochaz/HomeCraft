<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Panier;
use App\Entity\Adresse;
use App\Form\AdresseType;
use App\Entity\ModeExpedition;
use App\Entity\ModePaiement;

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
    public function creationCommande(UserInterface $user){
        
        return $this->render('commande/commandeCreee.html.twig', [
            'commande' => $commande
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

        $repoAdresseLivraison = $this->getDoctrine()->getRepository(Adresse::class);
        $adresseLivraison = $repoAdresseLivraison->findOneBy(['Client' => $user->getId()]);

        $formAdresseLivraison = $this->createForm(AdresseType::class, $adresseLivraison);
        dump($user->getId());
        return $this->render('commande/passageCommande.html.twig', [
            "panier" => $panier,
            "adresses" => $adresses,
            "modesExpedition" => $ModeExpedition,
            "modesPaiement" => $ModePaiement,
            "formAdresseLivraison" => $formAdresseLivraison->createView(),
        ]);
    }


}
