<?php

namespace App\Repository;

use App\Entity\EnergySource;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EnergySource>
 * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
 *
 * @method EnergySource|null find($id, $lockMode = null, $lockVersion = null)
 * @method EnergySource|null findOneBy(array $criteria, array $orderBy = null)
 * @method EnergySource[]    findAll()
 * @method EnergySource[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnergySourceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EnergySource::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(EnergySource $entity, bool $flush = true): void
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
    public function remove(EnergySource $entity, bool $flush = true): void
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
            DELETE FROM energy_source;
            ';

        $sql2 = '
            INSERT INTO energy_source (bio, water, wind, heat, sun, total, year)
            VALUES
            (92, 68, 1, 7, 0, 168, 2005),
            (97, 68, 1, 8, 0, 174, 2006),
            (102, 69, 1, 9, 0, 181, 2007),
            (102, 67, 2, 10, 0, 181, 2008),
            (106, 68, 3, 11, 0, 188, 2009),
            (116, 68, 4, 11, 0, 199, 2010),
            (109, 69, 6, 14, 0, 197, 2011),
            (116, 69, 7, 14, 0, 206, 2012),
            (114, 68, 9, 14, 0, 206, 2013),
            (114, 65, 11, 14, 0, 205, 2014),
            (120, 67, 14, 14, 0, 215, 2015),
            (124, 66, 16, 16, 0, 222, 2016),
            (129, 66, 17, 16, 0, 229, 2017);
        ';

        $stmt = $conn->prepare($sql);
        $stmt2 = $conn->prepare($sql2);

        $resultSet = $stmt->executeQuery();
        $resultSet = $stmt2->executeQuery();
    }
    // /**
    //  * @return EnergySource[] Returns an array of EnergySource objects
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
    public function findOneBySomeField($value): ?EnergySource
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
