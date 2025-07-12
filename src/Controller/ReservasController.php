<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Rooms;
use App\Entity\Persons;
use App\Entity\Booking;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ReservasController extends AbstractController
{
    public function lista()
    {
        $bd = $this->getDoctrine()->getManager();
        $bookings = $bd->getRepository(Booking::class)->findBy([],['id' => 'ASC']);
        $clientes = $bd->getRepository(Persons::class)->findBy([],['id' => 'ASC']);
        $habitaciones = $bd->getRepository(Rooms::class)->findBy([],['id' => 'ASC']);

        return $this->render('reservas/index.html.twig', ['clientes' => $clientes, 'habitaciones' => $habitaciones, 'bookings' => $bookings]);
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

            $booking->setPerson($persona);
            $booking->setFechallegada(new \DateTime($request->get('fechaLlegClienteRev')));

            $hora = $request->get('horaLlegClienteRev');
            $horaObj = \DateTime::createFromFormat('H:i', $hora);
            $booking->setHorallegada($horaObj);

            $booking->setAire($request->get('selectAireRev'));
            $booking->setCanthabitaciones($request->get('cantHabClienteRev'));
            $booking->setNumero(1);
            $booking->setObservaciones($request->get('observacionesReserva'));

            $bd->persist($booking);
        } 
        else 
        {
            $cliente = $bd->getRepository(Persons::class)->find($idCliente);
          
            $bd->persist($cliente);
        }

        $bd->flush();  

        return new JsonResponse(['response' => 'Ok']);
    }

   
}
