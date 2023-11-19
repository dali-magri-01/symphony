<?php

namespace App\Repository;

use App\Entity\TypeTiers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeTiers>
 *
 * @method TypeTiers|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeTiers|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeTiers[]    findAll()
 * @method TypeTiers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeTiersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeTiers::class);
    }

//    /**
//     * @return TypeTiers[] Returns an array of TypeTiers objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TypeTiers
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
