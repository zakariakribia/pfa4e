<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\DirecteurPedagogique;
use App\Entity\Entreprise;
use App\Entity\Etabliseement;
use App\Entity\Laureat;
use App\Entity\Secretaire;
use App\Form\RegistrationFormType;
use App\Security\LoginFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $authenticator): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('home');
        }

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            if(!in_array($form->get('roles')->getData()[0], $user->getRolesList())){
                dump($user->getRolesList());
                dump($form->get('roles')->getData()[0]);
                die;
                // return $this->render('registration/register.html.twig', [
                //     'registrationForm' => $form->createView(),
                // ]);
            }

            // Setting appropriate user type
            switch ($form->get('roles')->getData()[0]) {
                case 'ROLE_DIRECTEUR':
                    $user = new DirecteurPedagogique();       
                    break;
                case 'ROLE_LAUREAT':
                    $user = new Laureat();       
                    break;
                case 'ROLE_ETABLISSEMENT':
                        $user = new Etablissement();       
                        break;
                case 'ROLE_ENTREPRISE':
                    $user = new Entreprise();       
                    break;
                case 'ROLE_SECRETAIRE':
                    $user = new Secretaire();       
                    break;                            
                default:
                    
                    break;
            }
            
            $user->setEmail($form->get('email')->getData());
            $user->setNom($form->get('nom')->getData());
            $user->setPrenom($form->get('prenom')->getData());
            $user->setTelephone($form->get('telephone')->getData());
            $user->setDatenaissance($form->get('datenaissance')->getData());
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $user->setDeleted(false);
            
            $user->setRoles($form->get('roles')->getData());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
