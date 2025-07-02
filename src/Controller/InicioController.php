<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Rooms;

class InicioController extends AbstractController
{
    public function index($pantalla)
    {
        $bd = $this->getDoctrine()->getManager();

        $habTot = count($bd->getRepository(Rooms::class)->findBy([]));  
        $habDis = count($bd->getRepository(Rooms::class)->findBy(['status' => 1]));
        $habOcu = count($bd->getRepository(Rooms::class)->findBy(['status' => 2]));

        if($habOcu > 0)
        {
            $porcentaje = $habOcu / $habTot * 100;
            $porcentaje = round($porcentaje, 0);
        }
        else
        {
            $porcentaje = 0;
        }


        return $this->render('inicio/index.html.twig', ['pantalla' => $pantalla, 'habTot' => $habTot, 'habDis' => $habDis, 'porcentaje' => $porcentaje]);
    }
}
