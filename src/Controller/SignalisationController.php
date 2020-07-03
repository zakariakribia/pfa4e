<?php

namespace App\Controller;

use App\Entity\Signalisation;
use App\Form\SignalisationType;
use App\Repository\SignalisationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/signalisation")
 */
class SignalisationController extends AbstractController
{
    /**
     * @Route("/", name="signalisation_index", methods={"GET"})
     */
    public function index(SignalisationRepository $signalisationRepository): Response
    {
        return $this->render('signalisation/index.html.twig', [
            'signalisations' => $signalisationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="signalisation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $signalisation = new Signalisation();
        $form = $this->createForm(SignalisationType::class, $signalisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($signalisation);
            $entityManager->flush();

            return $this->redirectToRoute('signalisation_index');
        }

        return $this->render('signalisation/new.html.twig', [
            'signalisation' => $signalisation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="signalisation_show", methods={"GET"})
     */
    public function show(Signalisation $signalisation): Response
    {
        return $this->render('signalisation/show.html.twig', [
            'signalisation' => $signalisation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="signalisation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Signalisation $signalisation): Response
    {
        $form = $this->createForm(SignalisationType::class, $signalisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('signalisation_index');
        }

        return $this->render('signalisation/edit.html.twig', [
            'signalisation' => $signalisation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="signalisation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Signalisation $signalisation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$signalisation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($signalisation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('signalisation_index');
    }
}
