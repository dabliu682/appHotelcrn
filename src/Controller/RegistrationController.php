<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\Security\Http\Authenticator\FormLoginAuthenticator;


class RegistrationController extends AbstractController
{
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, UserAuthenticatorInterface $userAuthenticator, FormLoginAuthenticator $formLoginAuthenticator): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        $arrayUsers = [];

        $usuarios = $entityManager->getRepository(User::class)->findBy([], ['name' => 'ASC']);

        foreach ($usuarios as $usuario) 
        {
            $fechaIngreso = (!is_null($usuario->getUltimoaccesso())) ? $usuario->getUltimoaccesso()->format('Y-m-d H:i') : '';
            $tipo = (!is_null($usuario->getTipo())) ? $usuario->getTipo() : '';

            $arrayUsers[] = [
                                'name' => $usuario->getName(), 
                                'userName' => $usuario->getUserName(), 
                                'celular' => $usuario->getCelular(), 
                                'fechaUltimoAccesso' => $fechaIngreso,
                                'tipo' => $tipo,
                                'cambioClave' => ($usuario->isCambioclave()) ? 'Si' : 'No',
                            ];
        }

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $user->setPassword($userPasswordHasher->hashPassword($user, $form->get('plainPassword')->getData()));

            // Asignar el rol seleccionado (el campo es 'mapped' => false)
            $user->setRoles([(string) $form->get('roles')->getData()]);

            $entityManager->persist($user);
            $entityManager->flush();

            // Autenticar usuario correctamente
            //return $userAuthenticator->authenticateUser($user, $formLoginAuthenticator, $request);

            return $this->redirectToRoute('app_inicio');
        }

        //return $this->render('registration/register.html.twig', []);
        return $this->render('registration/listaUsuarios.html.twig', ['registrationForm' => $form->createView(), 'arrayUsers' => $arrayUsers]);
    }
}
