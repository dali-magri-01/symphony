<?php

namespace App\Repository;

use App\Entity\PieceComptable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PieceComptable>
 *
 * @method PieceComptable|null find($id, $lockMode = null, $lockVersion = null)
 * @method PieceComptable|null findOneBy(array $criteria, array $orderBy = null)
 * @method PieceComptable[]    findAll()
 * @method PieceComptable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PieceComptableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PieceComptable::class);
    }

    public function findFilteredData($fromDate, $toDate, $journal)
    {
        $qb = $this->createQueryBuilder('pc')
            ->leftJoin('pc.journal', 'j')
            ->leftJoin('pc.monnaie', 'm');

        if (!empty($fromDate)) {
            $qb->andWhere('pc.datepiece >= :fromDate')
                ->setParameter('fromDate', $fromDate);
        }

        if (!empty($toDate)) {
            $qb->andWhere('pc.datepiece <= :toDate')
                ->setParameter('toDate', $toDate);
        }

        if (!empty($journal)) {
            $qb->andWhere('j.id = :journal')
                ->setParameter('journal', $journal);
        }

        return $qb->getQuery()->getResult();
    }

    public function checkIfNumeroPcExistsForOthers(string $numeroPc, int $idpc, int $journal): bool
    {
        $qb = $this->createQueryBuilder('e');
        $qb->select('COUNT(e.id)');
        $qb->andWhere('e.numero_pc = :numeroPc');
        $qb->andWhere('e.id != :idpc'); // Exclure la pièce courante
        $qb->andWhere('e.journal = :journal');
        $qb->setParameter('numeroPc', $numeroPc);
        $qb->setParameter('idpc', $idpc);
        $qb->setParameter('journal', $journal);

        $count = $qb->getQuery()->getSingleScalarResult();

        return $count > 0;
    }

    public function findLastPieceNumberByMonth($month,$journal)
    {
        try {
            $result = $this->createQueryBuilder('p')
                ->select('COALESCE(p.numero_pc, :default) AS numero_pc')
                ->andWhere('SUBSTRING(p.numero_pc, 1, 2) = :month')
                ->andWhere('p.journal = :journal')
                ->orderBy('p.numero_pc', 'DESC')
                ->setMaxResults(1)
                ->setParameter('month', sprintf('%02d', $month))
                ->setParameter('journal', $journal)
                ->setParameter('default', '00000') // Valeur par défaut si aucun résultat n'est trouvé
                ->getQuery()
                ->getOneOrNullResult();

            if ($result === null) {
                // Si aucun résultat n'est trouvé, retourner la valeur par défaut
                return '00000';
            }

            // Si un résultat est trouvé, retourner la valeur de 'numero_pc'
            return $result['numero_pc'];
        } catch (\Doctrine\ORM\NoResultException $e) {
            // Si une exception est levée, cela signifie que la table est vide
            return '00000'; // Valeur par défaut si la table est vide
        }
    }






//    public function countPiecesForMonth($month)
//    {
//        return $this->createQueryBuilder('p')
//            ->select('COUNT(p.id)')
//            ->andWhere('MONTH(p.dateCreation) = :month')
//            ->setParameter('month', $month)
//            ->getQuery()
//            ->getSingleScalarResult();
//    }

//    /**
//     * @return PieceComptable[] Returns an array of PieceComptable objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PieceComptable
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
