<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Panier;

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
     * @Route("/passageCommande", name="PassageCommande")
     */
    public function passageCommande(UserInterface $user)//Commande $commande)
    {
        $repoPanier = $this->getDoctrine()->getRepository(Panier::class);
        $panier = $repoPanier->findOneBy(['Client' => $user->getId()]);
        return $this->render('commande/passageCommande.html.twig', [
            "panier" => $panier
        ]);
    }


}
