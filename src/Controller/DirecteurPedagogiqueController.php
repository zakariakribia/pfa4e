<?php

namespace App\Controller;

use App\Entity\DirecteurPedagogique;
use App\Form\DirecteurPedagogiqueType;
use App\Repository\DirecteurPedagogiqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/directeurPedagogique")
 */
class DirecteurPedagogiqueController extends AbstractController
{
    /**
     * @Route("/", name="directeur_pedagogique_index", methods={"GET"})
     */
    public function index(DirecteurPedagogiqueRepository $directeurPedagogiqueRepository): Response
    {
        return $this->render('directeur_pedagogique/index.html.twig', [
            'directeur_pedagogiques' => $directeurPedagogiqueRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="directeur_pedagogique_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $directeurPedagogique = new DirecteurPedagogique();
        $form = $this->createForm(DirecteurPedagogiqueType::class, $directeurPedagogique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($directeurPedagogique);
            $entityManager->flush();

            return $this->redirectToRoute('directeur_pedagogique_index');
        }

        return $this->render('directeur_pedagogique/new.html.twig', [
            'directeur_pedagogique' => $directeurPedagogique,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="directeur_pedagogique_show", methods={"GET"})
     */
    public function show(DirecteurPedagogique $directeurPedagogique): Response
    {
        return $this->render('directeur_pedagogique/show.html.twig', [
            'directeur_pedagogique' => $directeurPedagogique,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="directeur_pedagogique_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, DirecteurPedagogique $directeurPedagogique): Response
    {
        $form = $this->createForm(DirecteurPedagogiqueType::class, $directeurPedagogique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('directeur_pedagogique_index');
        }

        return $this->render('directeur_pedagogique/edit.html.twig', [
            'directeur_pedagogique' => $directeurPedagogique,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="directeur_pedagogique_delete", methods={"DELETE"})
     */
    public function delete(Request $request, DirecteurPedagogique $directeurPedagogique): Response
    {
        if ($this->isCsrfTokenValid('delete'.$directeurPedagogique->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($directeurPedagogique);
            $entityManager->flush();
        }

        return $this->redirectToRoute('directeur_pedagogique_index');
    }
}
