<?php

namespace App\Repository;

use App\Entity\Tamanhos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Tamanhos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tamanhos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tamanhos[]    findAll()
 * @method Tamanhos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TamanhosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tamanhos::class);
    }

    // /**
    //  * @return Tamanhos[] Returns an array of Tamanhos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tamanhos
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
