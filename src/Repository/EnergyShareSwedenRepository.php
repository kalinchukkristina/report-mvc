<?php

namespace App\Repository;

use App\Entity\EnergyShareSweden;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EnergyShareSweden>
 * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
 *
 * @method EnergyShareSweden|null find($id, $lockMode = null, $lockVersion = null)
 * @method EnergyShareSweden|null findOneBy(array $criteria, array $orderBy = null)
 * @method EnergyShareSweden[]    findAll()
 * @method EnergyShareSweden[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnergyShareSwedenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EnergyShareSweden::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(EnergyShareSweden $entity, bool $flush = true): void
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
    public function remove(EnergyShareSweden $entity, bool $flush = true): void
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
            DELETE FROM energy_share_sweden;
            ';

        $sql2 = '
            INSERT INTO energy_share_sweden (year, percentage)
            VALUES 
                (2005, 41),
                (2006, 43),
                (2007, 44),
                (2008, 45),
                (2009, 48),
                (2010, 47),
                (2011, 49),
                (2012, 51),
                (2013, 52),
                (2014, 52),
                (2015, 54),
                (2016, 54),
                (2017, 54);
        ';

        $stmt = $conn->prepare($sql);
        $stmt2 = $conn->prepare($sql2);

        $stmt->executeQuery();
        $stmt2->executeQuery();
    }



    // /**
    //  * @return EnergyShareSweden[] Returns an array of EnergyShareSweden objects
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
    public function findOneBySomeField($value): ?EnergyShareSweden
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
