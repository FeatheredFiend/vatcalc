<?php

namespace App\Repository;

use App\Entity\Vatcalc;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @extends ServiceEntityRepository<Vatcalc>
 *
 * @method Vatcalc|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vatcalc|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vatcalc[]    findAll()
 * @method Vatcalc[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VatcalcRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vatcalc::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Vatcalc $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Vatcalc $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @param string|null $term
     */
    public function getWithSearchQueryBuilder(?string $term): QueryBuilder
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb
            ->select('vc.id','vc.value', 'vc.value + vc.value * vc.vat / 100 as excludingvalue', 'vc.value - vc.value * vc.vat / 100 as includingvalue', 'vc.vat')
            ->from('App\Entity\Vatcalc', 'vc')
            ->orderBy('vc.id', 'ASC');

        return $qb;

    }

    // /**
    //  * @return Vatcalc[] Returns an array of Vatcalc objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vatcalc
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
