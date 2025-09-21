<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Turnos;
use App\Entity\Movimientos;

class TurnosController extends AbstractController
{
    public function abrirTurno()
    {
        $bd = $this->getDoctrine()->getManager();
        $usuario = $this->getUser(); 

        $obtenerCant = $bd->getRepository(Turnos::class)->obtenerCant();
        $obtenerCant = $obtenerCant[0][1] + 1;
        
        $turno = new Turnos(); 
        
        $turno->setUsuario($usuario);
        $turno->setStartdate(new \DateTime('now', new \DateTimeZone('America/Bogota')));
        $turno->setStatus(1);
        $turno->setNumero($obtenerCant);

        $bd->persist($turno);

        $movimiento = new movimientos();
        
        $movimiento->setFecha(new \DateTime('now', new \DateTimeZone('America/Bogota')));
        $movimiento->setTipo(1);
        $movimiento->setEstado(1);

        $bd->persist($movimiento);

        $bd->flush();

        return new JsonResponse(['response' => 'Ok']);
    }

    public function cerrarTurno()
    {
        $bd = $this->getDoctrine()->getManager();

        $turno = $bd->getRepository(Turnos::class)->findOneBy(['status' => 1]);

        $turno->setStatus(0);
        $turno->setEnddate(new \DateTime('now', new \DateTimeZone('America/Bogota')));

        $bd->persist($turno);

        $mov = $bd->getRepository(Movimientos::class)->findOneBy(['tipo' => 1, 'estado' => 1],['id' => 'desc']);
        $mov->setEstado(2);

        $bd->persist($mov);

        $bd->flush();

        return new JsonResponse(['response' => 'Ok']);
    }

    public function listaTurnos()
    {
        $bd = $this->getDoctrine()->getManager();
        $usuario = $this->getUser(); 

        $turnosCerrados = $bd->getRepository(Turnos::class)->findBy(['status' => 0]);

        /*<th>Numero</th>
        <th>Usuario</th>
        <th>Inicio</th>
        <th>Fin</th>
        <th>Hospedaje</th>
        <th>Servicios</th>
        <th>Tienda</th>
        <th>Valor</th>*/

        $tabla = [];

        foreach ($turnosCerrados as $turno) 
        {//dump($turno->getStartdate());
            $totalHospedaje = 0;
            $totalServicios = 0;
            $totalTienda = 0;

            foreach ($turno->getDetallesmovs() as $mov)
            {
                if($turno->getId() == $mov->getTurno()->getId())
                {
                    if(!is_null($mov->getServicio()))
                    {
                        $totalHospedaje += $mov->getValor();
                    }

                    if(!is_null($mov->getProducto()))
                    {
                        $totalTienda += $mov->getValor();
                    }
                }
            }

            $total = $totalHospedaje + $totalServicios + $totalTienda;

            $tabla[] =  [
                            'idTurno' => $turno->getId(), 
                            'numero' => $turno->getNumero(), 
                            'usuario' => $turno->getUsuario()->getName(), 
                            'hospedaje' => $totalHospedaje, 
                            'servicios' => $totalServicios, 
                            'tienda' => $totalTienda,
                            'total' => $total,
                            'inicio' => $turno->getStartdate()->format('Y-m-d H:i'),
                            'fin' => $turno->getEnddate()->format('Y-m-d H:i'),
                        ];
        }

        return $this->render('turnos/listaTurnos.html.twig', ['tabla' => $tabla]);
    }

}
