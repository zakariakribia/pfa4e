<?php

namespace App\Controller;

use App\Entity\TypeDiplome;
use App\Form\TypeDiplomeType;
use App\Repository\TypeDiplomeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/typeDiplome")
 */
class TypeDiplomeController extends AbstractController
{
    /**
     * @Route("/", name="type_diplome_index", methods={"GET"})
     */
    public function index(TypeDiplomeRepository $typeDiplomeRepository): Response
    {
        return $this->render('type_diplome/index.html.twig', [
            'type_diplomes' => $typeDiplomeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="type_diplome_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typeDiplome = new TypeDiplome();
        $form = $this->createForm(TypeDiplomeType::class, $typeDiplome);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeDiplome);
            $entityManager->flush();

            return $this->redirectToRoute('type_diplome_index');
        }

        return $this->render('type_diplome/new.html.twig', [
            'type_diplome' => $typeDiplome,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_diplome_show", methods={"GET"})
     */
    public function show(TypeDiplome $typeDiplome): Response
    {
        return $this->render('type_diplome/show.html.twig', [
            'type_diplome' => $typeDiplome,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="type_diplome_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypeDiplome $typeDiplome): Response
    {
        $form = $this->createForm(TypeDiplomeType::class, $typeDiplome);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_diplome_index');
        }

        return $this->render('type_diplome/edit.html.twig', [
            'type_diplome' => $typeDiplome,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_diplome_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TypeDiplome $typeDiplome): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeDiplome->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeDiplome);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_diplome_index');
    }
}
