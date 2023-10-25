<?php

namespace App\Controller;

use App\Entity\JoueurCrud;
use App\Form\JoueurCrudType;
use App\Repository\JoueurCrudRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/joueur/crud')]
class JoueurCrudController extends AbstractController
{
    #[Route('/', name: 'app_joueur_crud_index', methods: ['GET'])]
    public function index(JoueurCrudRepository $joueurCrudRepository): Response
    {
        return $this->render('joueur_crud/index.html.twig', [
            'joueur_cruds' => $joueurCrudRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_joueur_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $joueurCrud = new JoueurCrud();
        $form = $this->createForm(JoueurCrudType::class, $joueurCrud);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($joueurCrud);
            $entityManager->flush();

            return $this->redirectToRoute('app_joueur_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('joueur_crud/new.html.twig', [
            'joueur_crud' => $joueurCrud,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_joueur_crud_show', methods: ['GET'])]
    public function show(JoueurCrud $joueurCrud): Response
    {
        return $this->render('joueur_crud/show.html.twig', [
            'joueur_crud' => $joueurCrud,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_joueur_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, JoueurCrud $joueurCrud, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(JoueurCrudType::class, $joueurCrud);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_joueur_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('joueur_crud/edit.html.twig', [
            'joueur_crud' => $joueurCrud,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_joueur_crud_delete', methods: ['POST'])]
    public function delete(Request $request, JoueurCrud $joueurCrud, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$joueurCrud->getId(), $request->request->get('_token'))) {
            $entityManager->remove($joueurCrud);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_joueur_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
