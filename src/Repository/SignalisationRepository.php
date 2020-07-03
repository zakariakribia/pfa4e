<?php

namespace App\Repository;

use App\Entity\Signalisation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Signalisation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Signalisation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Signalisation[]    findAll()
 * @method Signalisation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SignalisationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Signalisation::class);
    }

    // /**
    //  * @return Signalisation[] Returns an array of Signalisation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Signalisation
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
