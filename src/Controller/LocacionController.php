<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Floors;
use App\Entity\Rooms;

class LocacionController extends AbstractController
{
    public function pisos()
    {
        $bd = $this->getDoctrine()->getManager();

        $pisos = $bd->getRepository(Floors::class)->findBy([],['id' => 'ASC']);

        return $this->render('locacion/pisos.html.twig', ['pisos' => $pisos]);
    }

    public function nuevoPiso(Request $request)
    {
        $bd = $this->getDoctrine()->getManager();
        $usuario = $this->getUser();

        $idPiso = $request->get('id');

        if ($idPiso == '0') 
        {
            $piso = new Floors();
            $piso->setName($request->get('nombre'));
            $piso->setUsucrea($usuario);
            $piso->setFechacrea(new \DateTime('now', new \DateTimeZone('America/Bogota'))); 

            $bd->persist($piso);

        } 
        else 
        {
            $piso = $bd->getRepository(Floors::class)->find($idPiso);
            $piso->setName($request->get('nombre'));
            $piso->setUsucrea($usuario);
            $piso->setFechacrea(new \DateTime('now', new \DateTimeZone('America/Bogota'))); 

            $bd->persist($piso);
        }

        $bd->flush();

        return new JsonResponse(['response' => 'Ok']);
    }

    public function eliminarPiso($id)
    {
        $bd = $this->getDoctrine()->getManager();

        $piso = $bd->getRepository(Floors::class)->find($id);

        if (count($piso->getRooms()) == 0) 
        {
            $bd->remove($piso);
            $bd->flush();

            return new JsonResponse(['response' => 'Ok']);
        } 
        else 
        {
            return new JsonResponse(['response' => 'Error']);
        }
    }

    public function habitaciones()
    {
        $bd = $this->getDoctrine()->getManager();

        $pisos = $bd->getRepository(Floors::class)->findBy([],['id' => 'ASC']);

        $rooms = $bd->getRepository(Rooms::class)->findBy([],['id' => 'ASC']);        

        return $this->render('locacion/habitaciones.html.twig', ['rooms' => $rooms, 'pisos' => $pisos]);
    }

    public function nuevaHabitacion(Request $request)
    {
        $bd = $this->getDoctrine()->getManager();

        $usuario = $this->getUser();

        $idHabitacion = $request->get('id');

        if ($idHabitacion == '0') 
        {
            $habitacion = new Rooms();
            $habitacion->setName($request->get('nombreHabitacion'));
            $piso = $bd->getRepository(Floors::class)->find($request->get('pisoHabitacion'));
            $habitacion->setFloor($bd->getRepository(Floors::class)->find($piso));
            $habitacion->setUsucrea($usuario);
            $habitacion->setBedNumber($request->get('numeroCama'));
            ($request->get('aireAcondicionado') == 'no') ? $habitacion->setAircond(false) : $habitacion->setAircond(true);
            ($request->get('ventilador') == 'no') ? $habitacion->setFan(false) : $habitacion->setFan(true);
            $habitacion->setTyperoom($request->get('tipoHabitacion'));
            $habitacion->setStatus(1);
            $habitacion->setFechacrea(new \DateTime('now', new \DateTimeZone('America/Bogota'))); 

            $bd->persist($habitacion);

        } 
        else 
        {
            $habitacion = $bd->getRepository(Rooms::class)->find($idHabitacion);  
            $habitacion->setName($request->get('nombreHabitacion'));
            $piso = $bd->getRepository(Floors::class)->find($request->get('pisoHabitacion'));
            $habitacion->setFloor($bd->getRepository(Floors::class)->find($piso));
            $habitacion->setUsucrea($usuario);
            $habitacion->setBedNumber($request->get('numeroCama'));
            ($request->get('aireAcondicionado') == 'no') ? $habitacion->setAircond(false) : $habitacion->setAircond(true);
            ($request->get('ventilador') == 'no') ? $habitacion->setFan(false) : $habitacion->setFan(true);
            $habitacion->setTyperoom($request->get('tipoHabitacion'));
            $habitacion->setStatus(1);
            $habitacion->setFechacrea(new \DateTime('now', new \DateTimeZone('America/Bogota'))); 

            $bd->persist($habitacion);
        }

        $bd->flush();

        return new JsonResponse(['response' => 'Ok']);
    }

    public function eliminarHabitacion($id)
    {
        $bd = $this->getDoctrine()->getManager();

        $habitacion = $bd->getRepository(Rooms::class)->find($id);

        if ($habitacion) 
        {
            $bd->remove($habitacion);
            $bd->flush();

            return new JsonResponse(['response' => 'Ok']);
        } 
        else 
        {
            return new JsonResponse(['response' => 'Error']);
        }
    }

    
}
