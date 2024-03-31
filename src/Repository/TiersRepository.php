<?php

namespace App\Repository;

use App\Entity\Tiers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tiers>
 *
 * @method Tiers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tiers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tiers[]    findAll()
 * @method Tiers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TiersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tiers::class);
    }


    public function findTiersByAccountId($accountId): array
    {
        $qb = $this->createQueryBuilder('tiers')
            ->select('tiers')
            ->join('tiers.tr_type_tiers', 'typeTiers') // Jointure avec TypeTiers
            ->join('typeTiers.comptes', 'compte') // Jointure avec Compte via TypeTiers
            ->where('compte.id = :accountId')
            ->setParameter('accountId', $accountId);

        return $qb->getQuery()->getResult();
    }



//    /**
//     * @return Tiers[] Returns an array of Tiers objects
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

//    public function findOneBySomeField($value): ?Tiers
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
