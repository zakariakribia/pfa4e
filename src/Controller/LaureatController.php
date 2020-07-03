<?php

namespace App\Controller;

use App\Entity\Laureat;
use App\Form\LaureatType;
use App\Repository\LaureatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/laureat")
 */
class LaureatController extends AbstractController
{
    /**
     * @Route("/", name="laureat_index", methods={"GET"})
     */
    public function index(LaureatRepository $laureatRepository): Response
    {
        return $this->render('laureat/index.html.twig', [
            'laureats' => $laureatRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="laureat_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $laureat = new Laureat();
        $form = $this->createForm(LaureatType::class, $laureat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($laureat);
            $entityManager->flush();

            return $this->redirectToRoute('laureat_index');
        }

        return $this->render('laureat/new.html.twig', [
            'laureat' => $laureat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="laureat_show", methods={"GET"})
     */
    public function show(Laureat $laureat): Response
    {
        return $this->render('laureat/show.html.twig', [
            'laureat' => $laureat,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="laureat_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Laureat $laureat): Response
    {
        $form = $this->createForm(LaureatType::class, $laureat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('laureat_index');
        }

        return $this->render('laureat/edit.html.twig', [
            'laureat' => $laureat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="laureat_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Laureat $laureat): Response
    {
        if ($this->isCsrfTokenValid('delete'.$laureat->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($laureat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('laureat_index');
    }
}
