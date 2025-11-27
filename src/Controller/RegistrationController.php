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
use Symfony\Component\HttpFoundation\JsonResponse;


class RegistrationController extends AbstractController
{
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, UserAuthenticatorInterface $userAuthenticator, FormLoginAuthenticator $formLoginAuthenticator): Response
    {
        $nombre = $request->get('registration_form')['name'];
        $usuario = $request->get('registration_form')['username'];
        $contraseña = $request->get('registration_form')['plainPassword'];
        $celular = $request->get('registration_form')['celular'];
        $tipo = $request->get('registration_form')['tipo'];
        $roles = $request->get('registration_form')['roles'];
        
        $user = new User();

        $user->setPassword($userPasswordHasher->hashPassword($user, $contraseña));
        $user->setRoles([(string) $roles]);
        $user->setUsername($usuario);
        $user->setName($nombre);
        $user->setCelular($celular);
        $user->setTipo($tipo);
        $user->setCambioclave(false);

        $entityManager->persist($user);

        $entityManager->flush();

        return new JsonResponse(['response' => 'Ok']);
    }

    public function listarUsuarios()
    {
        $bd = $this->getDoctrine()->getManager();
        $arrayUsers = [];

        $usuarios = $bd->getRepository(User::class)->findBy([], ['name' => 'ASC']);

        foreach ($usuarios as $usuario) 
        {
            $fechaIngreso = (!is_null($usuario->getUltimoaccesso())) ? $usuario->getUltimoaccesso()->format('Y-m-d H:i') : '';

            $tipo = 'Administrador del sistema';

            if(!is_null($usuario->getTipo()))
            {
                if($usuario->getTipo() == '1')
                {
                    $tipo = 'Empleado';
                }
                elseif($usuario->getTipo() == '2')
                {
                    $tipo = 'Administrador';
                }
                elseif ($usuario->getTipo() == '3') 
                {
                    $tipo = 'Asociado';
                }
            }

            $arrayUsers[] = [
                                'cambioClave' => ($usuario->isCambioclave()) ? 'Si' : 'No',
                                'userName' => $usuario->getUserName(), 
                                'fechaUltimoAccesso' => $fechaIngreso,
                                'celular' => $usuario->getCelular(), 
                                'isTurno' => $usuario->isTurno(),
                                'name' => $usuario->getName(), 
                                'id' => $usuario->getId(), 
                                'tipo' => $tipo,
                            ];
        }

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);

        return $this->render('registration/listaUsuarios.html.twig', ['registrationForm' => $form->createView(), 'arrayUsers' => $arrayUsers]);
    }

    public function cambiaTurno($id, $accion)
    {
        $bd = $this->getDoctrine()->getManager();

        $usuario = $bd->getRepository(User::class)->find($id);

        if($accion == 1)
        {
            $usuario->setTurno(true);
        }
        else
        {
            $usuario->setTurno(false);
        }

        $bd->persist($usuario);

        $bd->flush();

        return new JsonResponse(['response' => 'Ok']);
    }
}
