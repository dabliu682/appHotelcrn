<?php

namespace App\Repository;

use App\Entity\Movimientos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Movimientos>
 *
 * @method Movimientos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Movimientos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Movimientos[]    findAll()
 * @method Movimientos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovimientosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movimientos::class);
    }

    public function add(Movimientos $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Movimientos $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function dataInforme1($desde, $hasta, $query)
    {        
        $conexion = $this->getEntityManager()->getConnection();
        $sql = "select m.fecha, sum(d.valor) valor
                from public.movimientos m
                left join public.detallesmov d ON d.mov_id = m.id
                left join public.checkin ch ON ch.id = m.checkin_id
                left join public.persons p ON p.id = ch.cliente_id
                left join public.companys c ON c.id = p.compania_id
                LEFT join public.services s ON s.id = d.servicio_id
                left join public.servicetype st ON st.id = s.tipo_id
                where m.fecha >= '$desde' and m.fecha <= '$hasta' $query
                group by m.fecha";
        $stm = $conexion->prepare($sql);                            
        return $stm->executeQuery()->fetchAll();
    }

    public function dataInforme2($desde, $hasta)
    {        
        $conexion = $this->getEntityManager()->getConnection();
        $sql = "SELECT
                    CASE
                        WHEN st.name IN ('Hospedaje', 'Hospedaje motoristas') THEN 'Hospedaje'
                        WHEN st.name IS NULL THEN 'Tienda'
                        ELSE st.name
                    END AS tipo,
                    SUM(d.valor) AS valor
                FROM public.movimientos m
                LEFT JOIN public.detallesmov d ON d.mov_id = m.id
                LEFT JOIN public.checkin ch ON ch.id = m.checkin_id
                LEFT JOIN public.persons p ON p.id = ch.cliente_id
                LEFT JOIN public.companys c ON c.id = p.compania_id
                LEFT JOIN public.services s ON s.id = d.servicio_id
                LEFT JOIN public.servicetype st ON st.id = s.tipo_id
                WHERE m.fecha >= '$desde' AND m.fecha <= '$hasta'
                GROUP BY
                    CASE
                        WHEN st.name IN ('Hospedaje', 'Hospedaje motoristas') THEN 'Hospedaje'
                        WHEN st.name IS NULL THEN 'Tienda'
                        ELSE st.name
                    END
                ORDER BY tipo;";
        $stm = $conexion->prepare($sql);                            
        return $stm->executeQuery()->fetchAll();
    }

    public function dataInforme3($desde, $hasta, $query)
    {        
        $conexion = $this->getEntityManager()->getConnection();
        $sql = "SELECT tipo, sum(valor) valor
                FROM public.gastos
                where fechacrea >= '$desde' and fechacrea <= '$hasta' $query
                group by tipo";
        $stm = $conexion->prepare($sql);
        return $stm->executeQuery()->fetchAll();
    }

    public function dataInforme4($desde, $hasta, $query)
    {        
        $conexion = $this->getEntityManager()->getConnection();
        $sql = "SELECT fechacrea, tipo, detalles, valor
                FROM public.gastos
                where fechacrea >= '$desde' and fechacrea <= '$hasta' $query";
        $stm = $conexion->prepare($sql);
        return $stm->executeQuery()->fetchAll();
    }
}
