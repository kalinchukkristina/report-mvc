<?php

namespace App\Repository;

use App\Entity\EnergyShareWorld;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EnergyShareWorld>
 * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
 *
 * @method EnergyShareWorld|null find($id, $lockMode = null, $lockVersion = null)
 * @method EnergyShareWorld|null findOneBy(array $criteria, array $orderBy = null)
 * @method EnergyShareWorld[]    findAll()
 * @method EnergyShareWorld[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnergyShareWorldRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EnergyShareWorld::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(EnergyShareWorld $entity, bool $flush = true): void
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
    public function remove(EnergyShareWorld $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * deletes all data from table and insert default data
     */
    public function resetTable() {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            DELETE FROM energy_share_world;
            ';

        $sql2 = '
            INSERT INTO energy_share_world (year, percentage) 
            VALUES 
                (2000, 17.29), 
                (2001, 17.04), 
                (2002, 17.05),
                (2003, 16.85),
                (2004, 16.51),
                (2005, 16.33),
                (2006, 16.27),
                (2007, 16.15),
                (2008, 16.29),
                (2009, 16.81),
                (2010, 16.56),
                (2011, 16.63),
                (2012, 16.89),
                (2013, 17.06),
                (2014, 17.18),
                (2015, 17.24),
                (2016, 17.48);
        ';

        $stmt = $conn->prepare($sql);
        $stmt2 = $conn->prepare($sql2);

        $resultSet = $stmt->executeQuery();
        $resultSet = $stmt2->executeQuery();

    }


    // /**
    //  * @return EnergyShareWorld[] Returns an array of EnergyShareWorld objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EnergyShareWorld
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
