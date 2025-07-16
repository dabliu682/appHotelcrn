<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Turnos;

class TurnosController extends AbstractController
{
    public function abrirTurno()
    {
        $bd = $this->getDoctrine()->getManager();
        $usuario = $this->getUser();     

        $turno = new Turnos(); 
        
        $turno->setUsuario($usuario);
        $turno->setStartdate(new \DateTime('now', new \DateTimeZone('America/Bogota')));
        $turno->setStatus(1);
        $turno->setNumero(1);

        $bd->persist($turno);
        $bd->flush();

        return new JsonResponse(['response' => 'Ok']);
    }

}
