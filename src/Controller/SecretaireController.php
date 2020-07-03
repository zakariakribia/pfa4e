<?php

namespace App\Controller;

use App\Entity\Secretaire;
use App\Form\SecretaireType;
use App\Repository\SecretaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/secretaire")
 */
class SecretaireController extends AbstractController
{
    /**
     * @Route("/", name="secretaire_index", methods={"GET"})
     */
    public function index(SecretaireRepository $secretaireRepository): Response
    {
        return $this->render('secretaire/index.html.twig', [
            'secretaires' => $secretaireRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="secretaire_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $secretaire = new Secretaire();
        $form = $this->createForm(SecretaireType::class, $secretaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($secretaire);
            $entityManager->flush();

            return $this->redirectToRoute('secretaire_index');
        }

        return $this->render('secretaire/new.html.twig', [
            'secretaire' => $secretaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="secretaire_show", methods={"GET"})
     */
    public function show(Secretaire $secretaire): Response
    {
        return $this->render('secretaire/show.html.twig', [
            'secretaire' => $secretaire,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="secretaire_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Secretaire $secretaire): Response
    {
        $form = $this->createForm(SecretaireType::class, $secretaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('secretaire_index');
        }

        return $this->render('secretaire/edit.html.twig', [
            'secretaire' => $secretaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="secretaire_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Secretaire $secretaire): Response
    {
        if ($this->isCsrfTokenValid('delete'.$secretaire->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($secretaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('secretaire_index');
    }
}
