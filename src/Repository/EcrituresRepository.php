<?php

namespace App\Repository;

use App\Entity\Ecritures;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ecritures>
 *
 * @method Ecritures|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ecritures|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ecritures[]    findAll()
 * @method Ecritures[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EcrituresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ecritures::class);
    }



//    /**
//     * @return Ecritures[] Returns an array of Ecritures objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Ecritures
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
