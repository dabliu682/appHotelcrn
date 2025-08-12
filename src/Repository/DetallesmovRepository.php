<?php

namespace App\Repository;

use App\Entity\Detallesmov;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Detatallesmov>
 *
 * @method Detatallesmov|null find($id, $lockMode = null, $lockVersion = null)
 * @method Detatallesmov|null findOneBy(array $criteria, array $orderBy = null)
 * @method Detatallesmov[]    findAll()
 * @method Detatallesmov[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetallesmovRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Detatallesmov::class);
    }

    public function add(Detatallesmov $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Detatallesmov $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Detatallesmov[] Returns an array of Detatallesmov objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Detatallesmov
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
