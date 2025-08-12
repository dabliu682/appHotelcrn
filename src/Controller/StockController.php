<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Inventario;
use App\Entity\Entradas;
use App\Entity\Productos;
use Symfony\Component\Filesystem\Filesystem;
use PhpOffice\PhpSpreadsheet\IOFactory;
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

    public function cargarProductosPlano(Request $request)
    {
        $bd = $this->getDoctrine()->getManager();

        $usuario = $this->getUser();
        
        $anexo = $request->files->get('archivo');


        $fsObject = new Filesystem();

        $datosInsertar = [];

        $nombre = 'archivoProductos_tmp_'.date('his').'.xlsx';

        $ruta = $this->getParameter('documentos');

        $anexo->move($ruta, $nombre);
        
        $spreadsheet = IOFactory::load($ruta.$nombre);

        $hojaActual = $spreadsheet->getSheet(0);

        foreach($hojaActual->getRowIterator() as $fila) 
        {
            $row = $fila->getRowIndex();

            if($row > 1)
            {
                
                /* Se obtienen los valores de cada fila*/
                /* ---------------------------------------- */

                $codigo = $hojaActual->getCell('A'.$row)->getValue();
                $nombrePro = $hojaActual->getCell('B'.$row)->getValue();
                $tipo = $hojaActual->getCell('C'.$row)->getValue();

                $var = ['codigo' => $codigo, 'nombre' => $nombrePro, 'tipo' => $tipo];

                $datosInsertar[]=$var;
            }
        }

        unlink($ruta.'/'.$nombre);

        foreach ($datosInsertar as $datos) 
        {
            $producto = new Productos();
            $producto->setCodigo($datos['codigo']);
            $producto->setNombre($datos['nombre']);
            $producto->setTipo($datos['tipo']);
            $producto->setValor(0);
            $producto->setUsucrea($usuario);
            $producto->setFechacrea(new \DateTime('now', new \DateTimeZone('America/Bogota')));       

            $bd->persist($producto);
        }

        try 
        {
            $bd->flush();

            return new Response(json_encode(array("response"=>"Ok")));
        } 
        catch (\Exception $e) 
        {
            return new Response(json_encode(array("response"=>"Error")));
        }      

    }

    public function inventario()
    {
        $bd = $this->getDoctrine()->getManager();

        $inventario = $bd->getRepository(Inventario::class)->findBy([],['id' => 'ASC']);

        return $this->render('stock/inventario.html.twig',['inventario' => $inventario]);
    }

    public function entradas()
    {
        $bd = $this->getDoctrine()->getManager();

        $entradas = $bd->getRepository(Entradas::class)->findBy([],['id' => 'ASC']);
        $productos = $bd->getRepository(Productos::class)->findBy([],['id' => 'ASC']);

        return $this->render('stock/entradas.html.twig', ['entradas' => $entradas, 'productos' => $productos]);
    }

    public function guardarEntrada(Request $request)
    {
        $bd = $this->getDoctrine()->getManager();
        $usuario = $this->getUser();

        $idEntrada = $request->get('id');

        $codigo = $request->get('codigo');
        $cantidad = intval(str_replace('.', '', $request->get('cantidad')));
        $valor = floatval(str_replace('.', '', $request->get('valor')));
        $porcentaje = floatval(str_replace('.', '', $request->get('porcentaje')));
        $valEntProducto = floatval(str_replace('.', '', $request->get('valEntProducto')));
        $valSalProducto = floatval(str_replace('.', '', $request->get('valSalProducto')));
        $valVentaProducto = floatval(str_replace('.', '', $request->get('valVentaProducto')));
        $descripcion = $request->get('descripcion');
        $utilidad = ($valVentaProducto-$valEntProducto)*$cantidad;

        if ($idEntrada == '0') 
        {
            $producto = $bd->getRepository(Productos::class)->find($request->get('codigo'));

            $entrada = new Entradas();
            $entrada->setCodigo($producto);
            $entrada->setCantidad($cantidad);
            $entrada->setValor($valor);
            $entrada->setValundent($valEntProducto);
            $entrada->setValundsalida($valSalProducto);
            $entrada->setValventa($valVentaProducto);
            $entrada->setPorcentaje($porcentaje);
            $entrada->setUtilidad($utilidad);
            $entrada->setDescripcion($descripcion);
            $entrada->setUsucrea($usuario);
            $entrada->setFechacrea(new \DateTime('now', new \DateTimeZone('America/Bogota')));       

            $bd->persist($entrada);

            $producto->setValor($valVentaProducto);

            $bd->persist($producto);

            $inventario = $bd->getRepository(Inventario::class)->findOneBy(['codigo' => $producto]);
            
            if(!is_null($inventario))
            {
                $entradas = $inventario->getEntradas();
                $existencias = $inventario->getExistencias();

                $inventario->setEntradas($entradas+$entrada->getCantidad());
                $inventario->setExistencias($existencias+$entrada->getCantidad());
                $inventario->setFechamod(new \DateTime('now', new \DateTimeZone('America/Bogota')));
                $inventario->setUsumod($usuario);

                $bd->persist($inventario);
            }
            else
            {
                $inventario = new Inventario();
                $inventario->setCodigo($producto);
                $inventario->setEntradas($cantidad);
                $inventario->setSalidas(0);
                $inventario->setExistencias($cantidad);
                $inventario->setUsumod($usuario);
                $inventario->setFechamod(new \DateTime('now', new \DateTimeZone('America/Bogota')));

                $bd->persist($inventario);
            }
        } 
        else 
        {
            
        }

        $bd->flush();

        return new JsonResponse(['response' => 'Ok']);
    }

    public function obtenerProducto($id)
    {
        $bd = $this->getDoctrine()->getManager();
        
        $producto = $bd->getRepository(Productos::class)->find($id);

        $valor = $producto->getInventarios()[0]->getCodigo()->getValor();
        $existencias = $producto->getInventarios()[0]->getExistencias();

        return new JsonResponse(['valor' => $valor, 'existencias' => $existencias ]);
    }

    public function updateCantProducto($id, $accion, $cantidad)
    {
        $bd = $this->getDoctrine()->getManager();
        
        $producto = $bd->getRepository(Productos::class)->find($id);
        $inventario = $bd->getRepository(Inventario::class)->findOneBy(['codigo' => $producto]);

        $salidas = $inventario->getSalidas();
        $existencias = $inventario->getExistencias();

        if($accion == 1)
        {
            $inventario->setSalidas($salidas+$cantidad);
            $inventario->setExistencias($existencias-$cantidad);
            $bd->persist($inventario);
        }
        else
        {
            $inventario->setSalidas($salidas-$cantidad);
            $inventario->setExistencias($existencias+$cantidad);
            $bd->persist($inventario);
        }

        $bd->flush();

        return new JsonResponse(['response' => 'Ok']);
    }
}
