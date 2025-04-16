<?php

namespace App\Repository;

use App\Entity\CelestialBodies;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CelestialBodies>
 */
class CelestialBodiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CelestialBodies::class);
    }

    public function add(CelestialBodies $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CelestialBodies $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findCelestialBodiesByName(string $query)
    {

        $qb = $this->createQueryBuilder('cb');
        $qb
            ->where(
                $qb->expr()->andX(
                    $qb->expr()->orX(
                        $qb->expr()->like('cb.name', ':query'),
                    ),

                    $qb->expr()->isNotNull('cb.createdAt')
                )
            )
            ->setParameter('query', '%' . $query . '%')
        ;

        return $qb
            ->getQuery()
            ->getResult();
    }
    
//    /**
//     * @return CelestialBodies[] Returns an array of CelestialBodies objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

}
