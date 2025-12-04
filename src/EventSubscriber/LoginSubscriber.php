<?php

namespace App\EventSubscriber;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class LoginSubscriber implements EventSubscriberInterface
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            InteractiveLoginEvent::class => 'onInteractiveLogin',
        ];
    }

    public function onInteractiveLogin(InteractiveLoginEvent $event): void
    {
        $token = $event->getAuthenticationToken();
        if (!$token) {
            return;
        }

        $user = $token->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            return;
        }

        // actualizar último login (DateTimeImmutable)
        if (method_exists($user, 'setUltimoaccesso')) {
            $user->setUltimoaccesso(new \DateTime('now', new \DateTimeZone('America/Bogota')));
        }

        $this->em->persist($user);
        $this->em->flush();
    }
}