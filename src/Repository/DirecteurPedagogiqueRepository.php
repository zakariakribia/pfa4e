<?php

namespace App\Repository;

use App\Entity\DirecteurPedagogique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DirecteurPedagogique|null find($id, $lockMode = null, $lockVersion = null)
 * @method DirecteurPedagogique|null findOneBy(array $criteria, array $orderBy = null)
 * @method DirecteurPedagogique[]    findAll()
 * @method DirecteurPedagogique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DirecteurPedagogiqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DirecteurPedagogique::class);
    }

    // /**
    //  * @return DirecteurPedagogique[] Returns an array of DirecteurPedagogique objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DirecteurPedagogique
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
