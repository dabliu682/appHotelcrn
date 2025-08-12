<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Rooms;
use App\Entity\Persons;
use App\Entity\Booking;
use App\Entity\Turnos;
use App\Entity\Checkin;
use App\Entity\Services;
use App\Entity\Productos;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ReservasController extends AbstractController
{
    public function lista()
    {
        $bd = $this->getDoctrine()->getManager();
        $checkins = $bd->getRepository(checkin::class)->findBy([],['id' => 'ASC']);
        $clientes = $bd->getRepository(Persons::class)->findBy([],['id' => 'ASC']);
        $habitaciones = $bd->getRepository(Rooms::class)->findBy([],['id' => 'ASC']);
        $servicios = $bd->getRepository(Services::class)->findBy(['tipo' => [1,3,4]],['tipo' => 'ASC']);
        $productos = $bd->getRepository(Productos::class)->findProductos();

        return $this->render('reservas/index.html.twig', ['clientes' => $clientes, 'habitaciones' => $habitaciones, 'checkins' => $checkins, 'servicios' => $servicios, 'productos' => $productos]);
    }

    public function nuevaReserva()
    {
        $bd = $this->getDoctrine()->getManager();
        $clientes = $bd->getRepository(Persons::class)->findBy([],['id' => 'ASC']);
        $habitaciones = $bd->getRepository(Rooms::class)->findBy([],['id' => 'ASC']);

        return $this->render('reservas/nuevaReserva.html.twig', ['clientes' => $clientes, 'habitaciones' => $habitaciones]);
    }

    public function obtenerDatosClienteReserva($id)
    {
        $bd = $this->getDoctrine()->getManager();
        $cliente = $bd->getRepository(Persons::class)->find($id);        

        return new JsonResponse(['phone' => $cliente->getCellphone(), 'numberBus' => $cliente->getNumberBus(), 'company' => $cliente->getCompania() ? $cliente->getCompania()->getName() : '']);
    }

    public function guardarReserva(Request $request)
    {
        $bd = $this->getDoctrine()->getManager();
        $usuario = $this->getUser();

        $idReserva = $request->get('id');        

        if ($idReserva == '0') 
        {
            $booking = new Booking();

            $persona = $bd->getRepository(Persons::class)->find($request->get('clienteRev'));
            $turno = $bd->getRepository(Turnos::class)->findOneBy(['status' => 1]);

            $booking->setPerson($persona);
            $booking->setFechallegada(new \DateTime($request->get('fechaLlegClienteRev')));

            $hora = $request->get('horaLlegClienteRev');
            $horaObj = \DateTime::createFromFormat('H:i', $hora);
            $booking->setHorallegada($horaObj);

            $booking->setAire($request->get('selectAireRev'));
            $booking->setCanthabitaciones($request->get('cantHabClienteRev'));
            $booking->setNumero(1);
            $booking->setStatus(1);
            $booking->setTurno($turno);
            $booking->setFechacrea(new \DateTime('now', new \DateTimeZone('America/Bogota')));
            $booking->setObservaciones($request->get('observacionesReserva'));

            $bd->persist($booking);
        }

        $bd->flush();  

        return new JsonResponse(['response' => 'Ok']);
    }

    public function eliminarReserva($id)
    {
        $bd = $this->getDoctrine()->getManager();

        $booking = $bd->getRepository(booking::class)->find($id);

        foreach ($booking->getCheckins() as $checkin) 
        {
            $checkin->setEstado(4);

            $bd->persist($checkin);
        }

        $booking->setStatus(4);

        $bd->persist($booking);

        $bd->flush();  

        return new JsonResponse(['response' => 'Ok']);


    }

    public function crearCheckin($id)
    {
        $bd = $this->getDoctrine()->getManager();

        $booking = $bd->getRepository(booking::class)->find($id);

        $hab = $booking->getCanthabitaciones();

        for ($i=0; $i < $hab ; $i++) 
        { 
            $turno = $bd->getRepository(Turnos::class)->findOneBy(['status' => 1]);
            
            $newCheckin = new Checkin();
                
            $newCheckin->setReserva($booking);
            $newCheckin->setCliente($booking->getPerson());
            $newCheckin->setTurno($turno);
            $newCheckin->setfechaLlegada($booking->getFechallegada());
            $newCheckin->setHoraLlegada($booking->getHorallegada());
            $newCheckin->setEstado(0);

            $bd->persist($newCheckin);

            $booking->setStatus(2);

            $bd->persist($booking);

        }

        $bd->flush();  

        return new JsonResponse(['response' => 'Ok']);

    }

   
}
