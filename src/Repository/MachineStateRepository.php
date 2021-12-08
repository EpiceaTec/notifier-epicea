<?php

namespace App\Repository;

use App\Entity\MachineState;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MachineState|null find($id, $lockMode = null, $lockVersion = null)
 * @method MachineState|null findOneBy(array $criteria, array $orderBy = null)
 * @method MachineState[]    findAll()
 * @method MachineState[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MachineStateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MachineState::class);
    }

    // /**
    //  * @return MachineState[] Returns an array of MachineState objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MachineState
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
