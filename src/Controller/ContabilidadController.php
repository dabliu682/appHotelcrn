<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Movimientos;
use App\Entity\Detallesmov;
use App\Entity\Inventario;
use App\Entity\Productos;
use App\Entity\Service;
use App\Entity\Turnos;


class ContabilidadController extends AbstractController
{
    public function registrarVenta($detalle, $producto, $cantidad, $valor)
    {
        $bd = $this->getDoctrine()->getManager();

        $turno = $bd->getRepository(Turnos::class)->findOneBy(['status' => 1]);
        $mov = $bd->getRepository(Movimientos::class)->findOneBy(['tipo' => 1, 'estado' =>1],['id' => 'desc']);
        
        if($detalle == 1)
        {
            $producto = $bd->getRepository(Productos::class)->find($producto);
        }
        else 
        {
            $producto = $bd->getRepository(Service::class)->find($producto);
        }

        $detalleMov = new Detallesmov();

        $detalleMov->setMov($mov);

        if($detalle == 1)
        {
            $detalleMov->setProducto($producto);

            $inventario = $bd->getRepository(Inventario::class)->findOneBy(['codigo' => $producto]);

            $salidas = $inventario->getSalidas();
            $existencias = $inventario->getExistencias();

            $inventario->setSalidas($salidas+$cantidad);
            $inventario->setExistencias($existencias-$cantidad);

            $bd->persist($inventario);
        }
        else
        {
            $detalleMov->setServicio($producto);
        }

        $detalleMov->setTurno($turno);      
        $detalleMov->setCantidad($cantidad);
        $detalleMov->setValor($valor);
        $detalleMov->setSaldo(0);
        $detalleMov->setEstado(1);
        $detalleMov->setFormapago(1);

        $bd->persist($detalleMov);

        $bd->flush();

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
                        $tipoMov = 'Lavanderia';
                    }
                }
                else
                {
                    $tipoMov = 'Tienda';
                }

            } 
            

            $agrupaMov[$tipoMov][] = ['recibido' => $det->getValor(), 'pendiente' =>  $det->getSaldo()];
        }

        foreach ($agrupaMov as $key => $grupos) 
        {
            $valor = 0;
            $pendiente = 0;

            foreach ($grupos as $grupo) 
            {
                $valor += $grupo['recibido'];
                $pendiente += $grupo['pendiente'];
            }

            $tablaMov[] = ['concepto' => $key, 'valor' => $valor, 'pendiente' => $pendiente];
        }

        return new JsonResponse(['tablaVentas' => $tablaVentas, 'tablaMov' => $tablaMov]);
    }
}