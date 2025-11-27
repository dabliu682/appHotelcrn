<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ChangePasswordController extends AbstractController
{
    /**
     * Show the change password form (GET)
     *
     * @Route("/change-password/{id}", name="app_change_password", methods={"GET"})
     */
    public function show(Request $request, EntityManagerInterface $em, $id): Response
    {
        $user = $em->getRepository(User::class)->find($id);
        if (!$user) {
            $this->addFlash('danger', 'Usuario no encontrado.');
            return $this->redirectToRoute('app_login');
        }

        $form = $this->createForm(ChangePasswordType::class);

        return $this->render('security/change_password.html.twig', [
            'changeForm' => $form->createView(),
            'user' => $user,
        ]);
    }

    /**
     * Process the change password form (POST)
     *
     * @Route("/change-password/{id}", name="app_change_password_submit", methods={"POST"})
     */
    public function submit(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher, $id): Response
    {
        $user = $em->getRepository(User::class)->find($id);
        if (!$user) {
            $this->addFlash('danger', 'Usuario no encontrado.');
            return $this->redirectToRoute('app_login');
        }

        $form = $this->createForm(ChangePasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plain = $form->get('plainPassword')->getData();
            $hashed = $passwordHasher->hashPassword($user, $plain);
            $user->setPassword($hashed);
            // mark as password changed
            if (method_exists($user, 'setCambioclave')) {
                $user->setCambioclave(true);
            }

            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Contraseña actualizada. Puede iniciar sesión.');
            return $this->redirectToRoute('app_login');
        }

        // If form invalid, re-render the form with errors
        return $this->render('security/change_password.html.twig', [
            'changeForm' => $form->createView(),
            'user' => $user,
        ]);
    }
}
