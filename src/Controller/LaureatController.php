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
    
    /**
     * @Route("/profildip/{id}", name="laureat_diplome", methods={"GET"})
     */
    public function profildiplome(Laureat $laureat):Response
    {
        return $this->render('laureat/profilDip.html.twig',[
          'laureat' => $laureat
        ]);
    }

    /**
 * @Route("/profiletab/{id}", name="laureat_etablissement", methods={"GET","POST"})
 */
    public function profiletablissement(Laureat $laureat,Request $request):Response
    {
        $name = $request->request->get("name");

        $repository = $this->getDoctrine()->getRepository(Etablissement::class);
        $etablissements = $repository->findBy(
            ['nomEtablissement' => $name]
        );

        return $this->render('laureat/profilEtab.html.twig',[
            'laureat' => $laureat,
            'etablissements' => $etablissements,
            'name' => $name

        ]);
    }


    /**
     * @Route("/profilmodif/{id}", name="laureat_modif", methods={"GET","POST"})
     */
    public function profilmodification(Laureat $laureat,Request $request):Response
    {
        $form = $this->createForm(LaureatType::class, $laureat);
        $form->handleRequest($request);

        return $this->render('laureat/profilModif.html.twig', [
            'laureat' => $laureat,
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/profilmodifier/{id}", name="laureat_modifier", methods={"GET","POST"})
     */
    public function profilmodifier(Laureat $laureat,Request $request):Response
    {
        $form = $this->createForm(LaureatType::class, $laureat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form['photoUrl']->getData();

            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            try{
                $file->move($this->getParameter('image_directory'),$fileName);
            }catch (FileException $e){}

            $laureat->setPhotoUrl($fileName);
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Le compte a été modifié avec succes');

            return $this->redirectToRoute('laureat_apropos',array(

                'id' => $laureat->getId()));
        }


    }

    /**
     * @Route("/profilapropos/{id}", name="laureat_apropos", methods={"GET"})
     */
    public function profilapropos(Laureat $laureat):Response
    {
        return $this->render('laureat/profilApropos.html.twig',[
            'laureat' => $laureat
        ]);
    }

    /**
     * @Route("/profildesactiver/{id}", name="laureat_desactiver", methods={"GET","POST"})
     */
    public function profildesactiver(Laureat $laureat,Request $request):Response
    {
        $action=$request->request->get("desac");

        if($action)
        {
        $laureat->setDeleted(1);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($laureat);
        $entityManager->flush();

        return $this->render('laureat/profilDip.html.twig',[
            'laureat' => $laureat
        ]);
        }
        return $this->render('laureat/profilDesactiver.html.twig',[
            'laureat' => $laureat
        ]);
    }
}
