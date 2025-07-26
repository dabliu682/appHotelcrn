<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Rooms;
use App\Entity\Persons;
use App\Entity\Turnos;
use App\Entity\Documents;
use App\Entity\Companys;
use App\Entity\Booking;
use App\Entity\Services;

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
        $habitaciones = $bd->getRepository(Rooms::class)->findBy(['status' => 1]);
        $servicios = $bd->getRepository(Services::class)->findBy(['tipo' => 1]);
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

        $numClientes = count($bd->getRepository(Persons::class)->findBy([]));

        $reservas = $bd->getRepository(Booking::class)->findBy([],['id' => 'ASC']);

        $clientes = $bd->getRepository(Persons::class)->findBy([],['id' => 'ASC']);

        $clientesSelector = [];

        foreach ($clientes as $cliente) {
            $clientesSelector[] = [
                'id' => $cliente->getId(),
                'documentNumber' => $cliente->getDocumentNumber(),
                'name' => $cliente->getName(),
                'lastname' => $cliente->getLastname()
            ];
        }

        $habitacionesSelector = [];

        foreach ($habitaciones as $habitacion) {

            $tipo = ($habitacion->getTyperoom() == 1) ? 'Habitación sencilla' : (
                ($habitacion->getTyperoom() == 2) ? 'Habitación de dos camas' : (
                    ($habitacion->getTyperoom() == 3) ? 'Habitación sencilla con aire acondicionado' : (
                        ($habitacion->getTyperoom() == 4) ? 'Habitación de dos camas con aire acondicionado' : (
                            ($habitacion->getTyperoom() == 5) ? 'Habitación sencilla ventilador' : 'Habitación de dos camas ventilador'
                        )
                    )
                )
            );

            $habitacionesSelector[] = [
                'id' => $habitacion->getId(),
                'name' => $habitacion->getName().' - '.$tipo
            ];
        }

        $serviciosSelector = [];

        foreach ($servicios as $servicio) {

            $tipos = [
                1 => 'Sencilla',
                2 => 'Doble',
                3 => 'Sencilla con aire acondicionado',
                4 => 'Doble con aire acondicionado',
                5 => 'Sencilla con ventilador',
                6 => 'Doble con ventilador',
            ];
        
            $tipo = $tipos[$servicio->getTyperoom()] ?? '';

            ($tipo != '') ? $tipo = ' - '.$tipo : $tipo = '';

            $serviciosSelector[] = [
                'id' => $servicio->getId(),
                'name' => $servicio->getCode().' - '.$servicio->getTipo()->getName().$tipo.' - '.$servicio->getName()
            ];
        }

        $documents = $bd->getRepository(Documents::class)->findBy([],['id' => 'ASC']);
        $companias = $bd->getRepository(Companys::class)->findBy([],['id' => 'ASC']);

        // Obtener todas las habitaciones con su piso
        $habitaciones = $bd->getRepository(Rooms::class)->findBy([], ['id' => 'ASC']);

        $habitacionesPorPiso = [];
        
        foreach ($habitaciones as $habitacion) {
            $piso = $habitacion->getFloor() ? $habitacion->getFloor()->getName() : 'Sin piso';
            // Traduce el tipo de habitación a texto legible

            $tipos = [
                1 => 'Sencilla',
                2 => 'Doble',
                3 => 'Sencilla con aire acondicionado',
                4 => 'Doble con aire acondicionado',
                5 => 'Sencilla con ventilador',
                6 => 'Doble con ventilador',
            ];
        
            $tipo = $tipos[$habitacion->getTyperoom()] ?? 'Desconocido';
            // status: 1=Disponible, 2=Ocupada
        
            $disponible = $habitacion->getStatus();

            $habitacionesPorPiso[$piso][] = [
                'nombre' => $habitacion->getName(),
                'tipo' => $tipo,
                'disponible' => $disponible,
            ];
        }

        $parametros = [
                        'habTot' => $habTot, 
                        'habDis' => $habDis, 
                        'porcentaje' => $porcentaje, 
                        'numClientes' => $numClientes, 
                        'turno' => $turno, 
                        'reservas' => $reservas, 
                        'clientes' => $clientes, 
                        'clientesSelector' => $clientesSelector, 
                        'documents' => $documents, 
                        'companias' => $companias,
                        'habitacionesSelector' => $habitacionesSelector,
                        'habitacionesPorPiso' => $habitacionesPorPiso,
                        'serviciosSelector' => $serviciosSelector
                    ];


        return $this->render('inicio/dashboard.html.twig', $parametros);
    }
}


