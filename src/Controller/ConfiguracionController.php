<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Documents;
use App\Entity\Companys;
use App\Entity\Servicetype;
use App\Entity\Services;
use App\Entity\Rooms;
use Symfony\Component\HttpFoundation\JsonResponse;

class ConfiguracionController extends AbstractController
{
    public function tipoDoc()
    {
        $bd = $this->getDoctrine()->getManager();

        $tiposDoc = $bd->getRepository(Documents::class)->findBy([],['id' => 'ASC']);

        return $this->render('configuracion/tipoDoc.html.twig', ['tiposDoc' => $tiposDoc]);
    }

    public function guardarTipodoc(Request $request)
    {
        $bd = $this->getDoctrine()->getManager();
        $usuario = $this->getUser();

        $idDoc= $request->get('id');

        if ($idDoc == '0') 
        {
            $tipoDoc = new Documents();
            $tipoDoc->setName($request->get('nombre'));
            $tipoDoc->setUsucrea($usuario);
            $tipoDoc->setFechacrea(new \DateTime('now', new \DateTimeZone('America/Bogota'))); 

            $bd->persist($tipoDoc);

        } 
        else 
        {
            $tipoDoc = $bd->getRepository(Documents::class)->find($idDoc);
            $tipoDoc->setName($request->get('nombre'));
            $tipoDoc->setUsucrea($usuario);
            $tipoDoc->setFechacrea(new \DateTime('now', new \DateTimeZone('America/Bogota'))); 

            $bd->persist($tipoDoc);
        }

        $bd->flush();  

        return new JsonResponse(['response' => 'Ok']);
    }

    public function eliminarTipodoc($id)
    {
        $bd = $this->getDoctrine()->getManager();

        $tipoDoc = $bd->getRepository(Documents::class)->find($id);
        
        try 
        {
            $bd->remove($tipoDoc);
            $bd->flush();
            return new JsonResponse(['response' => 'Ok']);
        } 
        catch (\Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException $e) {
            // Error de llave foránea
            return new JsonResponse(['response' => 'Error']);
        } 
    }

    public function companias()
    {
        $bd = $this->getDoctrine()->getManager();

        $companias = $bd->getRepository(Companys::class)->findBy([],['id' => 'ASC']);

        return $this->render('configuracion/companias.html.twig', ['companias' => $companias]);
    }

    public function nuevaCompania(Request $request)
    {
        $bd = $this->getDoctrine()->getManager();
        $usuario = $this->getUser();

        $idCompania = $request->get('id');

        if ($idCompania == '0') 
        {
            $compania = new Companys();
            $compania->setName($request->get('nombre'));
            $compania->setNit($request->get('nit'));
            $compania->setUsuariocrea($usuario);

            $bd->persist($compania);

        } 
        else 
        {
            $compania = $bd->getRepository(Companys::class)->find($idCompania);
            $compania->setName($request->get('nombre'));
            $compania->setNit($request->get('nit'));
            $compania->setUsuariocrea($usuario);
            $bd->persist($compania);
        }

        $bd->flush();

        return new JsonResponse(['response' => 'Ok']);
    }

    public function eliminarCompania($id)
    {
        $bd = $this->getDoctrine()->getManager();

        $compania = $bd->getRepository(Companys::class)->find($id);
        
        try 
        {
            $bd->remove($compania);
            $bd->flush();
            return new JsonResponse(['response' => 'Ok']);
        } 
        catch (\Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException $e) {
            // Error de llave foránea
            return new JsonResponse(['response' => 'Error']);
        } 
    }

    public function servicios()
    {
        // Aquí puedes implementar la lógica para mostrar los servicios
        return $this->render('configuracion/servicios.html.twig');
    }

    public function tiposServicios()
    {
        $bd = $this->getDoctrine()->getManager();

        $tiposServicios = $bd->getRepository(Servicetype::class)->findBy([],['id' => 'ASC']);

        return $this->render('configuracion/tiposServicios.html.twig', ['tiposServicios' => $tiposServicios]);
    }

    public function guardarTiposServ(Request $request)
    {
        $bd = $this->getDoctrine()->getManager();
        $usuario = $this->getUser();

        $idTipoServ = $request->get('id');

        if ($idTipoServ == '0') 
        {
            $tipoServ = new Servicetype();
            $tipoServ->setName($request->get('nombre'));
            $tipoServ->setUsucrea($usuario);
            $tipoServ->setFechacrea(new \DateTime('now', new \DateTimeZone('America/Bogota'))); 

            $bd->persist($tipoServ);

        } 
        else 
        {
            $tipoServ = $bd->getRepository(Servicetype::class)->find($idTipoServ);
            $tipoServ->setName($request->get('nombre'));
            $tipoServ->setUsucrea($usuario);
            $tipoServ->setFechacrea(new \DateTime('now', new \DateTimeZone('America/Bogota'))); 

            $bd->persist($tipoServ);
        }

        $bd->flush();  

        return new JsonResponse(['response' => 'Ok']);
    }

    public function eliminarTiposServ($id)
    {
        $bd = $this->getDoctrine()->getManager();

        $tipoServ = $bd->getRepository(Servicetype::class)->find($id);
        
        try 
        {
            $bd->remove($tipoServ);
            $bd->flush();
            return new JsonResponse(['response' => 'Ok']);
        } 
        catch (\Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException $e) {
            // Error de llave foránea
            return new JsonResponse(['response' => 'Error']);
        } 
    }

    public function listaServicios($filtro)
    {
        $bd = $this->getDoctrine()->getManager();

        $TiposServicios = $bd->getRepository(Servicetype::class)->findBy([],['id' => 'ASC']);

        if ($filtro != '0') {
            $servicios = $bd->getRepository(Services::class)->findBy(['tipo' => $filtro], ['id' => 'ASC']);
        } else {
            $servicios = $bd->getRepository(Services::class)->findBy([], ['id' => 'ASC']);
        }

        return $this->render('configuracion/listaServicios.html.twig', ['servicios' => $servicios, 'TiposServicios' => $TiposServicios]);
    }

    public function guardarServicio(Request $request)
    {
        $bd = $this->getDoctrine()->getManager();
        $usuario = $this->getUser();

        $idServicio = $request->get('id');

        if ($idServicio == '0') 
        {
            $servicio = new Services();
            $servicio->setName($request->get('nombreServ'));
            $servicio->setCode($request->get('codigoServ'));
            $servicio->setPrice(str_replace('.', '', $request->get('valorServ')));
            $servicio->setTipo($bd->getRepository(Servicetype::class)->find($request->get('selectTipoServ')));
            $servicio->setUsucrea($usuario);
            $servicio->setActive(true);
            $servicio->setFechacrea(new \DateTime('now', new \DateTimeZone('America/Bogota')));
            ($request->get('horasServ') != '') ? $servicio->setHours($request->get('horasServ')) : '';

            if($request->get('tipoHabitacion') != '') { $servicio->setTyperoom($request->get('tipoHabitacion')); }            

            $bd->persist($servicio);

        } 
        else 
        {
            $servicio = $bd->getRepository(Services::class)->find($idServicio);
            $servicio->setName($request->get('nombreServ'));
            $servicio->setCode($request->get('codigoServ'));
            $servicio->setPrice(str_replace('.', '', $request->get('valorServ')));
            $servicio->setTipo($bd->getRepository(Servicetype::class)->find($request->get('selectTipoServ')));
            $servicio->setUsucrea($usuario);
            $servicio->setFechacrea(new \DateTime('now', new \DateTimeZone('America/Bogota'))); 
            $servicio->setHours($request->get('horasServ'));

            if($request->get('tipoHabitacion') != '') { $servicio->setTyperoom($request->get('tipoHabitacion')); } 

            $bd->persist($servicio);
        }

        $bd->flush();

        return new JsonResponse(['response' => 'Ok']);
    }

    public function eliminarServicio($id)
    {
        $bd = $this->getDoctrine()->getManager();

        $servicio = $bd->getRepository(Services::class)->find($id);
        
        try 
        {
            $bd->remove($servicio);
            $bd->flush();
            return new JsonResponse(['response' => 'Ok']);
        } 
        catch (\Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException $e) {
            // Error de llave foránea
            return new JsonResponse(['response' => 'Error']);
        } 
    }

    public function cambiaEstadoServicio($id, $estado)
    {
        $bd = $this->getDoctrine()->getManager();

        $servicio = $bd->getRepository(Services::class)->find($id);

        if($estado == '1')
        {
            $servicio->setActive(true);
        }
        else{
            $servicio->setActive(false);
        }    

        $bd->persist($servicio);
        $bd->flush();

        return new JsonResponse(['response' => 'Ok']);
    }

    public function obtenerServicio($id)
    {
        $bd = $this->getDoctrine()->getManager();

        $servicio = $bd->getRepository(Services::class)->find($id);
        $habitaciones = $bd->getRepository(Rooms::class)->findBy(['typeroom' => $servicio->getTyperoom(), 'status' => 1]);

        $habitacionesSelector = [];

        foreach ($habitaciones as $habitacion) {

            $tipo = ($habitacion->getTyperoom() == 1) ? 'Habitación sencilla' : (
                ($habitacion->getTyperoom() == 2) ? 'Habitación doble ' : (
                    ($habitacion->getTyperoom() == 3) ? 'Habitación sencilla con aire acondicionado' : (
                        ($habitacion->getTyperoom() == 4) ? 'Habitación doble con aire acondicionado' : (
                            ($habitacion->getTyperoom() == 5) ? 'Habitación sencilla con ventilador' : 'Habitación doble con ventilador'
                        )
                    )
                )
            );

            $habitacionesSelector[] = [
                'id' => $habitacion->getId(),
                'name' => $habitacion->getName().' - '.$tipo
            ];
        }

        return new JsonResponse([ 'id' => $servicio->getId(), 'name' => $servicio->getName(), 'code' => $servicio->getCode(), 'price' => $servicio->getPrice(), 'tipo' => $servicio->getTipo()->getId(), 'typeroom' => $servicio->getTyperoom(), 'habitacionesSelector' => $habitacionesSelector, 'horas' => $servicio->getHours() ]);
    }
}
