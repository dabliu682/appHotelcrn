<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Persons;
use App\Entity\Entradas;
use App\Entity\Productos;
use Symfony\Component\HttpFoundation\JsonResponse;

class StockController extends AbstractController
{
    public function listas()
    {
        return $this->render('stock/listas.html.twig');
    }

    public function productos()
    {
        $bd = $this->getDoctrine()->getManager();

        $productos = $bd->getRepository(Productos::class)->findBy([],['id' => 'ASC']);

        return $this->render('stock/productos.html.twig', ['productos' => $productos]);
    }

    public function guardarProducto(Request $request)
    {
        $bd = $this->getDoctrine()->getManager();
        $usuario = $this->getUser();

        $idProducto = $request->get('id');

        if ($idProducto == '0') 
        {
            $producto = new Productos();
            $producto->setCodigo($request->get('codigo'));
            $producto->setNombre($request->get('nombre'));
            $producto->setTipo($request->get('tipo'));
            $producto->setValor(0);
            $producto->setUsucrea($usuario);
            $producto->setFechacrea(new \DateTime('now', new \DateTimeZone('America/Bogota')));       

            $bd->persist($producto);

        } 
        else 
        {
            $servicio = $bd->getRepository(Services::class)->find($idServicio);
            $servicio->setName($request->get('nombreServ'));
            $servicio->setCode($request->get('codigoServ'));
            $servicio->setPrice($request->get('valorServ'));
            $servicio->setTipo($bd->getRepository(Servicetype::class)->find($request->get('selectTipoServ')));
            $servicio->setUsucrea($usuario);
            $servicio->setFechacrea(new \DateTime('now', new \DateTimeZone('America/Bogota'))); 

            if($request->get('tipoHabitacion') != '') { $servicio->setTyperoom($request->get('tipoHabitacion')); } 

            $bd->persist($servicio);
        }

        $bd->flush();

        return new JsonResponse(['response' => 'Ok']);
    }

    public function inventario()
    {
        return $this->render('stock/inventario.html.twig');
    }

    public function entradas()
    {
        $bd = $this->getDoctrine()->getManager();

        $entradas = $bd->getRepository(Entradas::class)->findBy([],['id' => 'ASC']);
        $productos = $bd->getRepository(Productos::class)->findBy([],['id' => 'ASC']);

        return $this->render('stock/entradas.html.twig', ['entradas' => $entradas, 'productos' => $productos]);
    }
}
