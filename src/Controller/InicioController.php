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
use App\Entity\Bonos;
use App\Entity\Detallesmov;
use App\Entity\Movimientos;
use App\Entity\Productos;
use App\Entity\User;

class InicioController extends AbstractController
{
    public function index($pantalla)
    {
        $bd = $this->getDoctrine()->getManager();

        $turno = $bd->getRepository(Turnos::class)->findOneBy(['status' => 1]);

        if(!is_null($turno))
        {
            $numero = str_pad($turno->getNumero(), 5, "0", STR_PAD_LEFT);
            $turnoActual = $turno->getUsuario()->getName().' - '.$numero;
        }
        else
        {
            $turnoActual = 'Sin turno';
        }


        return $this->render('inicio/index.html.twig', ['pantalla' => $pantalla, 'turnoActivo' => $turnoActual]);
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
        $mov = $bd->getRepository(Movimientos::class)->findOneBy(['tipo' => 1, 'estado' => 1],['id' => 'desc']);

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

        $reservas = $bd->getRepository(Booking::class)->findBy([],['id' => 'desc']);

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
                ($habitacion->getTyperoom() == 2) ? 'Habitación doble' : (
                    ($habitacion->getTyperoom() == 3) ? 'Habitación sencilla con aire acondicionado' : (
                        ($habitacion->getTyperoom() == 4) ? 'Habitación doble con aire acondicionado' : (
                            ($habitacion->getTyperoom() == 5) ? 'Habitación sencilla ventilador' : 'Habitación doble con ventilador'
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
        
        foreach ($habitaciones as $habitacion) 
        {
            $fechaSalida = '';

            if($habitacion->getStatus() == 2)
            {
                foreach ($habitacion->getCheckins() as $checkin) 
                {
                    if($checkin->getEstado() == 1)
                    {
                        $fechaSalida = $checkin->getfechasalida()->format('Y-m-d').' '.$checkin->getHorasalida()->format('h:i');                       
                    }
                }
            }
            
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

            $habitacionesPorPiso[$piso][] = [ 'nombre' => $habitacion->getName(),'tipo' => $tipo, 'disponible' => $disponible, 'fechaSalida' => $fechaSalida];
        }

        $productos = $bd->getRepository(Productos::class)->findBy([],['id' => 'ASC']);

        $selectPrtoductos=[];

        foreach ($productos as $producto) 
        {
            $existencias = 0;

            foreach ($producto->getInventarios() as $inventario) 
            {
                $existencias += $inventario->getExistencias();
            }

            if($existencias > 0)
            {
                $selectPrtoductos[] = $producto;
            }
            
        }

        $servicios = $bd->getRepository(Services::class)->findBy(['typeroom' => null ],['name' => 'ASC']);

        $selectServicios=[];

        foreach ($servicios as $servicio) 
        {
            
            $selectServicios[] = $servicio;
            
        }

        $detalles = $bd->getRepository(Detallesmov::class)->findBy(['turno' => $turno, 'mov' => $mov ],['id' => 'desc']);

        $tablaVentas = [];

        foreach ($detalles as $det) 
        {
            if(!is_null($det->getServicio()))
            {
                $producto = $det->getServicio()->getName();
            }
            else
            {
                $producto = $det->getProducto()->getCodigo().'-'.$det->getProducto()->getNombre();
            }    
            
            $tablaVentas[] = ['producto' => $producto, 'cantidad' => $det->getCantidad(),'valor' => $det->getValor() ];
        }


        $tablaMov = [];

        $detallesMov = $bd->getRepository(Detallesmov::class)->findBy(['turno' => $turno]);

        $agrupaMov = [];

        foreach ($detallesMov as $det) 
        {
            if(is_null($det->getServicio()) && is_null($det->getProducto()))
            {
                if($det->getMov()->getTipo() == 4)
                {
                    $tipoMov = 'Salidas';
                }
                else
                {
                    $tipoMov = 'Entradas';
                }
            }
            else
            {
                if(!is_null($det->getServicio()))
                {
                    if($det->getServicio()->getTipo()->getId() == 1 || $det->getServicio()->getTipo()->getId() == 2 || $det->getServicio()->getTipo()->getId() == 3)
                    {
                        $tipoMov = 'Hospedaje';
                    }
                    elseif($det->getServicio()->getTipo()->getId() == 4)
                    {
                        $tipoMov = 'Lavandería';
                    }
                }
                else
                {
                    $tipoMov = 'Tienda';
                }

            } 
            

            $agrupaMov[$tipoMov][] = ['recibido' => $det->getValor(), 'pendiente' =>  $det->getSaldo(), 'estado' => $det->getEstado(), 'bono' => 0];
        }

        $bonos = $bd->getRepository(Bonos::class)->findBy(['turno' => $turno]);

        foreach ($bonos as $bono) 
        {
            $agrupaMov['Bonos'][] = ['recibido' => 0, 'pendiente' =>  0, 'estado' => 0, 'bono' => $bono->getValor()];
        }

        foreach ($agrupaMov as $key => $grupos) 
        {
            $valor = 0;
            $pendiente = 0;
            $bonos = 0;

            foreach ($grupos as $grupo) 
            {
                $valor += $grupo['recibido'];
                $pendiente += ($grupo['estado'] != 2) ? $grupo['pendiente'] : 0;
                $bonos += $grupo['bono'];

            }

            $tablaMov[] = ['concepto' => $key, 'valor' => $valor, 'pendiente' => $pendiente, 'bono' => $bonos];
        }


        if(!is_null($turno))
        {
            $numero = str_pad($turno->getNumero(), 5, "0", STR_PAD_LEFT);
            $turnoActual = $numero;
            $nomActual = $turno->getUsuario()->getName();
        }
        else
        {
            $turnoActual = 'Sin turno';
            $nomActual = '';
        }

        $beneficiarios = $bd->getRepository(User::class)->findBy(['tipo' => '3' ],['id' => 'ASC']);

        $beneficiariosSelector = [];

        foreach ($beneficiarios as $cliente) {
            $beneficiariosSelector[] = [
                'id' => $cliente->getId(),
                'name' => $cliente->getName(),
            ];
        }


        $parametros = [
                        'beneficiariosSelector' => $beneficiariosSelector,
                        'habitacionesSelector' => $habitacionesSelector,
                        'habitacionesPorPiso' => $habitacionesPorPiso,
                        'serviciosSelector' => $serviciosSelector,
                        'clientesSelector' => $clientesSelector, 
                        'selectServicios' => $selectServicios,
                        'productos' => $selectPrtoductos,
                        'numClientes' => $numClientes, 
                        'tablaVentas' => $tablaVentas,
                        'turnoActual' => $turnoActual,
                        'porcentaje' => $porcentaje, 
                        'nomActual' => $nomActual,
                        'documents' => $documents, 
                        'companias' => $companias,
                        'reservas' => $reservas, 
                        'clientes' => $clientes, 
                        'tablaMov' => $tablaMov,
                        'habTot' => $habTot, 
                        'habDis' => $habDis, 
                        'turno' => $turno, 
                    ];


        return $this->render('inicio/dashboard.html.twig', $parametros);
    }
}


