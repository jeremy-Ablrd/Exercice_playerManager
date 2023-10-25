<?php

namespace App\Controller;

use App\Entity\Joueur;
use App\Form\JoueurType;
use App\Repository\JoueurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class JoueurController extends AbstractController
{
    #[Route('', name: 'index')]
    public function index(): Response
    {
        return $this->render('joueur/index.html.twig', [
            'controller_name' => 'JoueurController',
        ]);
    }

    #[Route('/joueur/new', name: 'app_joueur_new', methods:['POST', 'GET'])]
    public function newPlayer(EntityManagerInterface $entityManager, Request $request): Response
    {
        // Creer joueur depuis un formulaire
        $creerJoueur = new Joueur();

        $formulaire = $this->createForm(JoueurType::class, $creerJoueur);       //comprendre un peu mieux la syntaxe de cette ligne
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()){

            $inscription = $formulaire->getData();
            $entityManager->persist($inscription);   // 
            $entityManager->flush();

            return $this->render('joueur/index.html.twig', []);

        } else {
            return $this->render('joueur/pageInscription.html.twig', [
                'formulaire'=>$formulaire
            ]);
        }

    }

    #[Route('/all', name: 'app_joueur_get')]
    public function getAll(JoueurRepository $joueurRepo): Response
    {       
            return $this->render('joueur/index.html.twig', [
                "joueurs"=>$joueurRepo->findAll(),]);
    }
}
