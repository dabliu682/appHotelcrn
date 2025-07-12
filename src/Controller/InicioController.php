<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Rooms;
use App\Entity\Persons;
use App\Entity\Turnos;

class InicioController extends AbstractController
{
    public function index($pantalla)
    {
        return $this->render('inicio/index.html.twig', ['pantalla' => $pantalla]);
    }

    public function dashboard()
    {
        $bd = $this->getDoctrine()->getManager();

        $habTot = count($bd->getRepository(Rooms::class)->findBy([]));  
        $habDis = count($bd->getRepository(Rooms::class)->findBy(['status' => 1]));
        $habOcu = count($bd->getRepository(Rooms::class)->findBy(['status' => 2]));
        $turno = $bd->getRepository(Turnos::class)->findOneBy(['status' => 1]);

        if($habOcu > 0)
        {
            $porcentaje = $habOcu / $habTot * 100;
            $porcentaje = round($porcentaje, 0);
        }
        else
        {
            $porcentaje = 0;
        }

        $clientes = count($bd->getRepository(Persons::class)->findBy([]));


        return $this->render('inicio/dashboard.html.twig', ['habTot' => $habTot, 'habDis' => $habDis, 'porcentaje' => $porcentaje, 'clientes' => $clientes, 'turno' => $turno]);
    }
}


