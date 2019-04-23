<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\InscriptionType;
use App\Entity\Client;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Adresse;
use App\Form\AdresseType;
use Psr\Log\LoggerInterface;

class SecuriteController extends AbstractController
{
    /**
     * @Route("/inscription", name="securite_inscription")
     */
    public function inscription(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder, LoggerInterface $logger)
    {
        $logger->info('I just got the logger');
        $client = new Client();
        $adresseLivraison = new Adresse();

        $form = $this->createForm(InscriptionType::class, $client);
        $formAdresseLivraison = $this->createForm(AdresseType::class, $adresseLivraison);

        $form->handleRequest($request);
        $formAdresseLivraison->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() && $formAdresseLivraison->isSubmitted() && $formAdresseLivraison->isValid()) {
            $hash = $encoder->encodePassword($client, $client->getPasswordClient());

            $client->setPasswordClient($hash);
            $manager->persist($client);
            $manager->persist($adresseLivraison);
            $manager->flush();

            return $this->redirectToRoute('home');
        } else{
            $logger->error('An error occurred');
        }
        
        return $this->render('securite/inscriptionClient.html.twig', [
            'form' => $form->createView(),
            'formAdresseLivraison' => $formAdresseLivraison->createView()
        ]);
    }

    /**
     * @Route("/login", name="security_login")
     */
    public function login(){
        return $this->redirectToRoute('home');
    }
    
    /**
     * @Route("/logout", name="security_logout")
     */
    public function logout(){
        return $this->redirectToRoute('home');
    }


}
