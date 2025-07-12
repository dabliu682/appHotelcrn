<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Persons;
use App\Entity\Documents;
use App\Entity\Companys;
use Symfony\Component\HttpFoundation\JsonResponse;

class ClientesController extends AbstractController
{
    public function lista()
    {
        $bd = $this->getDoctrine()->getManager();

        $documents = $bd->getRepository(Documents::class)->findBy([],['id' => 'ASC']);
        $companias = $bd->getRepository(Companys::class)->findBy([],['id' => 'ASC']);
        $clientes = $bd->getRepository(Persons::class)->findBy([],['id' => 'ASC']);

        return $this->render('clientes/lista.html.twig', ['clientes' => $clientes, 'documents' => $documents, 'companias' => $companias]);
    } 
    
    public function guardarClientes(Request $request)
    {
        $bd = $this->getDoctrine()->getManager();
        $usuario = $this->getUser();

        $idCliente = $request->get('id');        

        if ($idCliente == '0') 
        {
            $cliente = new Persons();
            $cliente->setName($request->get('nombresCliente'));
            $cliente->setLastname($request->get('apellidosCliente'));
            $cliente->setCellphone($request->get('numeroCelCliente'));
            $cliente->setDocument($bd->getRepository(Documents::class)->find($request->get('tipoDoc')));
            $cliente->setDocumentNumber($request->get('numeroDocCliente'));
           
            $cliente->setUsucrea($usuario);
            $cliente->setFechacrea(new \DateTime('now', new \DateTimeZone('America/Bogota'))); 

            if($request->get('selectCompaniaCliente') != '')
            {
                 $cliente->setCompania($bd->getRepository(Companys::class)->find($request->get('selectCompaniaCliente')));
            }

            if($request->get('placaCliente') != '')
            {
                 $cliente->setPlaca($request->get('placaCliente'));
            }

            if($request->get('numeroVehiculoCliente') != '')
            {
                 $cliente->setNumberBus($request->get('numeroVehiculoCliente'));
            }
            
            $bd->persist($cliente);
        } 
        else 
        {
            $cliente = $bd->getRepository(Persons::class)->find($idCliente);
            $cliente->setName($request->get('nombresCliente'));
            $cliente->setLastname($request->get('apellidosCliente'));
            $cliente->setCellphone($request->get('numeroCelCliente'));
            $cliente->setDocument($bd->getRepository(Documents::class)->find($request->get('tipoDoc')));
            $cliente->setDocumentNumber($request->get('numeroDocCliente'));
            $cliente->setUsucrea($usuario);
            $cliente->setFechacrea(new \DateTime('now', new \DateTimeZone('America/Bogota'))); 

            if($request->get('selectCompaniaCliente') != '')
            {
                 $cliente->setCompania($bd->getRepository(Companys::class)->find($request->get('selectCompaniaCliente')));
            }

            if($request->get('placaCliente') != '')
            {
                 $cliente->setPlaca($request->get('placaCliente'));
            }

            if($request->get('numeroVehiculoCliente') != '')
            {
                 $cliente->setNumberBus($request->get('numeroVehiculoCliente'));
            }

            $bd->persist($cliente);
        }

        $bd->flush();  

        return new JsonResponse(['response' => 'Ok']);
    }

    public function eliminarClientes($id)
    {
        $bd = $this->getDoctrine()->getManager();

        $cliente = $bd->getRepository(Persons::class)->find($id);
        
        try 
        {
            $bd->remove($cliente);
            $bd->flush();
            return new JsonResponse(['response' => 'Ok']);
        } 
        catch (\Exception $e) 
        {
            return new JsonResponse(['response' => 'Error', 'message' => $e->getMessage()]);
        }
    }
}
