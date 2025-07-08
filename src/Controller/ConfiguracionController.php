<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Documents;
use App\Entity\Companys;
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
}
