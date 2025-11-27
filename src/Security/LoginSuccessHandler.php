<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Doctrine\ORM\EntityManagerInterface;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    private UrlGeneratorInterface $urlGenerator;
    private TokenStorageInterface $tokenStorage;
    private EntityManagerInterface $em;

    public function __construct(UrlGeneratorInterface $urlGenerator, TokenStorageInterface $tokenStorage, EntityManagerInterface $em)
    {
        $this->urlGenerator = $urlGenerator;
        $this->tokenStorage = $tokenStorage;
        $this->em = $em;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $user = $token->getUser();

        // If user must change password (cambioclave === false), invalidate session and redirect
        if (method_exists($user, 'isCambioclave') && $user->isCambioclave() === false) {
            // Ensure the change password route receives the user id
            $userId = method_exists($user, 'getId') ? $user->getId() : null;

            // logout this token and invalidate session
            try {
                $this->tokenStorage->setToken(null);
                $request->getSession()->invalidate();
            } catch (\Throwable $e) {
                // ignore
            }

            $url = $this->urlGenerator->generate('app_change_password', ['id' => $userId]);
            return new RedirectResponse($url);
        }

        // Otherwise, respect target_path stored in session for firewall 'main'
        $session = $request->getSession();
        if ($session && $session->has('_security.main.target_path')) {
            $target = $session->get('_security.main.target_path');
            return new RedirectResponse($target);
        }

        // default
        $url = $this->urlGenerator->generate('app_inicio');
        return new RedirectResponse($url);
    }
}
