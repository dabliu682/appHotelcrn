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
use App\Entity\Movimientos;
use App\Entity\Detallesmov;
use App\Entity\Documents;
use App\Entity\Companys;
use App\Entity\Inventario;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ReservasController extends AbstractController
{
    public function lista()
    {
        $bd = $this->getDoctrine()->getManager();
        $checkins = $bd->getRepository(checkin::class)->findBy([],['id' => 'DESC']);
        $clientes = $bd->getRepository(Persons::class)->findBy([],['id' => 'ASC']);
        $habitaciones = $bd->getRepository(Rooms::class)->findBy([],['id' => 'ASC']);
        $servicios = $bd->getRepository(Services::class)->findBy(['tipo' => [1,3,4]],['tipo' => 'ASC']);
        $productos = $bd->getRepository(Productos::class)->findProductos();
        $documents = $bd->getRepository(Documents::class)->findBy([],['id' => 'ASC']);
        $companias = $bd->getRepository(Companys::class)->findBy([],['id' => 'ASC']);
        $serviciosCheck = $bd->getRepository(Services::class)->findBy(['tipo' => [3,4]],['name' => 'ASC']);        

        return $this->render('reservas/index.html.twig', ['clientes' => $clientes, 'habitaciones' => $habitaciones, 'checkins' => $checkins, 'servicios' => $servicios, 'productos' => $productos, 'documents' => $documents, 'companias' => $companias, 'serviciosCheck' => $serviciosCheck]);
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
            $numMax = $bd->getRepository(Booking::class)->findNumMax();
            $booking->setNumero($numMax[0]['numero']);
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
            $newCheckin->setTipocliente(0);

            $bd->persist($newCheckin);

            $booking->setStatus(2);

            $bd->persist($booking);

        }

        $bd->flush();  

        return new JsonResponse(['response' => 'Ok']);

    }

    public function checkin(Request $request)
    {
        $bd = $this->getDoctrine()->getManager();

        $checkin = $bd->getRepository(Checkin::class)->find($request->get('idCheckin'));

        $horaLlega = $request->get('horaLlegClienteRev');      
        $horaLlega = \DateTime::createFromFormat('H:i', $horaLlega);

        $horaSalida = $request->get('horaSalidaClienteRev');      
        $horaSalida = \DateTime::createFromFormat('H:i', $horaSalida);

        if(!is_null($checkin->getReserva()))
        {
            $booking = $checkin->getReserva();

            $booking->setFechallegada(new \DateTime($request->get('fechaLlegClienteRev')));
            $booking->setHorallegada($horaLlega);

            $booking->setStatus(3);

            $bd->persist($booking);
        }
        
        $checkin->setFechallegada(new \DateTime($request->get('fechaLlegClienteRev')));
        $checkin->setHorallegada($horaLlega);

        $checkin->setFechasalida(new \DateTime($request->get('fechaSalidaClienteRev')));
        $checkin->setHorasalida($horaSalida);

        $persona = $bd->getRepository(Persons::class)->find($request->get('clienteRev'));

        $checkin->setCliente($persona);

        $turno = $bd->getRepository(Turnos::class)->findOneBy(['status' => 1]);

        $checkin->setTurno($turno);

        $toalla = (!is_null($request->get('Toalla'))) ? true : false;
        $control = (!is_null($request->get('control'))) ? true : false;
        $aire = (!is_null($request->get('aire'))) ? true : false;
        $cobija = (!is_null($request->get('cobija'))) ? true : false;
        $llaves = (!is_null($request->get('llaves'))) ? true : false;

        $checkin->setToalla($toalla);
        $checkin->setControl($control);
        $checkin->setAire($aire);
        $checkin->setCobija($cobija);
        $checkin->setLlaves($llaves);
        $tipoCliente = ($request->get('tipoClienteCheckin') == 'motorista') ? 1 : 2; 
        $checkin->setTipocliente($tipoCliente);
        $checkin->setObservaciones($request->get('observacionesCheckin'));    
        
        $idHab = $request->get('idHab');

        $habitacion = $bd->getRepository(Rooms::class)->find($idHab);      
        
        $habitacion->setStatus(2);

        $bd->persist($habitacion);

        $checkin->setHabitacion($habitacion);
        $checkin->setEstado(1);

        $bd->persist($checkin);

        $mov = new Movimientos();

        $mov->setCheckin($checkin);
        $mov->setFecha(new \DateTime('now', new \DateTimeZone('America/Bogota')));
        $mov->setTipo(2);
        $mov->setEstado(0);
        $mov->setTurno($turno);

        $bd->persist($mov);

        $checkin->setMovimiento($mov);

        $bd->persist($checkin);

        $servicios = json_decode($request->get('servicios'), true);

        foreach ($servicios as $servicio) 
        {
            $serv = $bd->getRepository(Services::class)->find($servicio[7]); 
            $valorPag = floatval(str_replace(',', '.', str_replace('.', '', $servicio[5])));
            $saldo = floatval(str_replace(',', '.', str_replace('.', '', $servicio[6])));

            $detalle = new Detallesmov();
            $detalle->setMov($mov);
            $detalle->setServicio($serv);
            $detalle->setValor($valorPag);
            $detalle->setSaldo($saldo);
            $detalle->setFormapago($servicio[9]);
            $detalle->setEstado(1);
            $detalle->setTurno($turno);            

            $bd->persist($detalle);
        }

        $productos = json_decode($request->get('productos'), true);

        if(!is_null($productos))
        {
            foreach ($productos as $producto) 
            {
                $prod = $bd->getRepository(Productos::class)->find($producto[2]); 
                $valor = floatval(str_replace(',', '.', str_replace('.', '', $producto[5])));
                $saldo = floatval(str_replace(',', '.', str_replace('.', '', $producto[6])));
                $cantidad = $producto[4];
    
                $detalle = new Detallesmov();
                $detalle->setMov($mov);
                $detalle->setProducto($prod);
                $detalle->setValor($valor);
                $detalle->setSaldo($saldo);
                $detalle->setCantidad($cantidad);
                $detalle->setFormapago($producto[7]);
                $detalle->setEstado(1);
                $detalle->setTurno($turno);            
    
                $bd->persist($detalle);

                $inventario = $bd->getRepository(Inventario::class)->findOneBy(['codigo' => $prod]);

                $salidas = $inventario->getSalidas()+$cantidad; 
                $existencias = $inventario->getExistencias()-$cantidad; 

                $inventario->setSalidas($salidas);
                $inventario->setExistencias($existencias);

                $bd->persist($inventario);
            }
        }


        $bd->flush();

        return new JsonResponse(['response' => 'Ok']);
    }

    public function agregarServicioCheckin(Request $request)
    {
        $bd = $this->getDoctrine()->getManager(); 

        $turno = $bd->getRepository(Turnos::class)->findOneBy(['status' => 1]);

        $id = $request->get('id');

        $checkin = $bd->getRepository(Checkin::class)->find($id);

        $servicios = json_decode($request->get('servicio'), true);

        foreach ($servicios as $servicio) 
        {
            $serv = $bd->getRepository(Services::class)->find($servicio[6]); 
            $valorPag = floatval(str_replace(',', '.', str_replace('.', '', $servicio[4])));
            $saldo = floatval(str_replace(',', '.', str_replace('.', '', $servicio[5])));

            $detalle = new Detallesmov();
            $detalle->setMov($checkin->getMovimientos()[0]);
            $detalle->setServicio($serv);
            $detalle->setValor($valorPag);
            $detalle->setSaldo($saldo);
            $detalle->setFormapago($servicio[7]);
            $detalle->setEstado(1);
            $detalle->setTurno($turno);            

            $bd->persist($detalle);
        }

        $bd->flush();

        return new JsonResponse(['response' => 'Ok']);
    }

    public function agregarProductoCheckin(Request $request)
    {
        $bd = $this->getDoctrine()->getManager(); 

        $turno = $bd->getRepository(Turnos::class)->findOneBy(['status' => 1]);

        $id = $request->get('id');

        $checkin = $bd->getRepository(Checkin::class)->find($id);

        $productos = json_decode($request->get('producto'), true);

        if(!is_null($productos))
        {
            foreach ($productos as $producto) 
            {
                $prod = $bd->getRepository(Productos::class)->find($producto[6]); 
                $valor = floatval(str_replace(',', '.', str_replace('.', '', $producto[4])));
                $saldo = floatval(str_replace(',', '.', str_replace('.', '', $producto[5])));
                $cantidad = $producto[8];
    
                $detalle = new Detallesmov();
                $detalle->setMov($checkin->getMovimientos()[0]);
                $detalle->setProducto($prod);
                $detalle->setValor($valor);
                $detalle->setSaldo($saldo);
                $detalle->setCantidad($cantidad);
                $detalle->setFormapago($producto[7]);
                $detalle->setEstado(1);
                $detalle->setTurno($turno);            
    
                $bd->persist($detalle);

                $inventario = $bd->getRepository(Inventario::class)->findOneBy(['codigo' => $prod]);

                $salidas = $inventario->getSalidas()+$cantidad; 
                $existencias = $inventario->getExistencias()-$cantidad; 

                $inventario->setSalidas($salidas);
                $inventario->setExistencias($existencias);

                $bd->persist($inventario);
            }
        }


        $bd->flush();

         return new JsonResponse(['response' => 'Ok']);
    }

    public function obtenerCheckin($id)
    {
        $bd = $this->getDoctrine()->getManager();
        $checkin = $bd->getRepository(checkin::class)->find($id);

        $detallesMov = $bd->getRepository(Movimientos::class)->findOneBy(['checkin' => $checkin ]);

        $datos = [
                    'cliente' => $checkin->getCliente()->getName().' '.$checkin->getCliente()->getLastname(),
                    'tipoCliente' =>$checkin->getTipocliente(),
                    'fechaLlegada' =>$checkin->getFechallegada()->format('Y-m-d'),
                    'horaLlegada' =>$checkin->getHorallegada()->format('H:i'),
                    'fechaSalida' =>$checkin->getFechasalida()->format('Y-m-d'),
                    'horaSalida' =>$checkin->getHorasalida()->format('H:i'),
                    'observaciones' =>$checkin->getObservaciones(),
                    'toalla' => $checkin->isToalla(),
                    'aire' => $checkin->isAire(),
                    'cobija' => $checkin->isCobija(),
                    'control' => $checkin->isControl(),
                    'llaves' => $checkin->isLlaves(),
                 ];

        $productos = [];
        $servicios = [];
        $saldo = 0;

        foreach ($detallesMov->getDetallesmovs() as $detalle) 
        {
            if(!is_null($detalle->getProducto()))
            {
                $formasPago = ['1' => 'Efectivo', '2' => 'Bono', '3' => 'Transacción'];

                $productos[] =  [
                                    'producto' => $detalle->getProducto()->getCodigo().' - '.$detalle->getProducto()->getNombre(),
                                    'formaPago' => $formasPago[$detalle->getFormapago()],
                                    'cantidad' => $detalle->getCantidad(),
                                    'valUnd' => ($detalle->getValor()+$detalle->getSaldo()) / $detalle->getCantidad(),
                                    'valor' => $detalle->getValor()+$detalle->getSaldo(),
                                    'saldo' => $detalle->getSaldo(),
                                    'valorPag' => $detalle->getValor(),
                                ];
                
                $saldo += $detalle->getSaldo();
            }

            if(!is_null($detalle->getServicio()))
            {
                $tiposHabitacion = [

                    '1' => 'Habitación sencilla',
                    '2' => 'Habitación doble',
                    '3' => 'Habitación sencilla con aire acondicionado',
                    '4' => 'Habitación doble con aire acondicionado',
                    '5' => 'Habitación sencilla ventilador',
                    '6' => 'Habitación doble con ventilador',
                ];

                $habitacion = "";

                if($detalle->getServicio()->getTipo()->getId() == 1 || $detalle->getServicio()->getTipo()->getId() == 2)
                {
                    $habitacion = $checkin->getHabitacion()->getName();
                }

                $formasPago = ['1' => 'Efectivo', '2' => 'Bono', '3' => 'Transacción'];

                $servicios[] = [
                                    'servicio' => $detalle->getServicio()->getName().' / '.$detalle->getServicio()->getHours().' Horas', 
                                    'habitacion' => $habitacion, 
                                    'formaPago' => $formasPago[$detalle->getFormapago()], 
                                    'valor' => $detalle->getValor()+$detalle->getSaldo(), 
                                    'valorPag' => $detalle->getValor(), 
                                    'saldo' => $detalle->getSaldo(), 
                                ];

                $saldo += $detalle->getSaldo();
            }
        }

        return new JsonResponse(['datos' => $datos, 'servicios' => $servicios, 'productos' => $productos, 'saldo' => $saldo]);
    }

    public function eliminarCheckin($id)
    {
        $bd = $this->getDoctrine()->getManager();

        $checkin = $bd->getRepository(checkin::class)->find($id);

        $reserva = $checkin->getReserva();

        $checkins = $bd->getRepository(checkin::class)->findBy(['reserva' => $reserva]);

        $cant0 = 0;
        $cant1 = 0;
        $cant2 = 0;

        if(count($checkins) > 1)
        {
            foreach ($checkins as $check) 
            {
                if($check->getEstado() == 1)
                {
                    $cant1++;
                }

                if($check->getEstado() == 2)
                {
                    $cant2++;
                }
            }

            if($cant1 > 0 && $cant2 > 0)
            {
                $reserva->setStatus(3);
            }
            else
            {
                if($cant1 > 0 && $cant2 == 0 )
                {
                    $reserva->setStatus(3);
                }
                else
                {
                    $reserva->setStatus(5);
                }
            }
        }
        else
        {
            $reserva->setStatus(5);
        }



        $bd->remove($checkin);

        $bd->flush();

        return new JsonResponse(['response' => 'Ok']);
    }

    public function checkout($id)
    {
        $bd = $this->getDoctrine()->getManager();
        $checkin = $bd->getRepository(checkin::class)->find($id);
        $turno = $bd->getRepository(Turnos::class)->findOneBy(['status' => 1]);

        foreach ($checkin->getMovimientos() as $movimiento)
        {
            $saldo = 0;

            foreach ($movimiento->getDetallesmovs() as $detalle) 
            {
                if($detalle->getSaldo() > 0)
                {
                    $newDetalle = new Detallesmov();
                    $newDetalle->setMov($detalle->getMov());
                    $newDetalle->setServicio($detalle->getServicio());
                    $newDetalle->setProducto($detalle->getProducto());
                    $newDetalle->setValor($detalle->getSaldo());
                    $newDetalle->setSaldo(0);
                    $newDetalle->setFormapago(1);
                    $newDetalle->setEstado(2);
                    $newDetalle->setTurno($turno);            

                    $bd->persist($newDetalle);
                }

                $detalle->setEstado(2);

                $bd->persist($detalle);
               
            }

            $movimiento->setEstado(1);

            $bd->persist($movimiento);
        }

        $checkin->setEstado(2);

        $bd->persist($checkin);

        $habitacion = $checkin->getHabitacion(); 

        $habitacion->setStatus(3);

        $bd->persist($habitacion);

        $bd->flush();

        return new JsonResponse(['response' => 'Ok']);

    }

   
}
