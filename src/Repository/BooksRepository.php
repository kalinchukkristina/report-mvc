<?php

namespace App\Repository;

use App\Entity\Books;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Books>
 * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
 *
 * @method Books|null find($id, $lockMode = null, $lockVersion = null)
 * @method Books|null findOneBy(array $criteria, array $orderBy = null)
 * @method Books[]    findAll()
 * @method Books[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BooksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Books::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Books $entity, bool $flush = true): void
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
    public function remove(Books $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * deletes all data from table and insert default data
     */
    public function resetTable() {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            DELETE FROM books;
            ';

        $sql2 = "
            INSERT INTO books (title, isbn, author, pic)
            VALUES 
                ('The Night in Lisbon', 9780091115708, 'Erich Maria Remarque', 'https://upload.wikimedia.org/wikipedia/en/b/b1/The.Night.In.Lisbon.cover.jpg'),
                ('A Connecticut Yankee in King Arthur’s Court', 123456, 'Mark Twain', 'https://www.publishersweekly.com/images/cached/ARTICLE_PHOTO/photo/000/000/028/28133-v1-185x.JPG'),
                ('The adventures of Sherlock Holmes', 0759398747, 'Arthur Conan Doyle', 'https://img.thriftbooks.com/api/images/m/16edeba80bcc9aa503e7544ace4f8b7fdb69f771.jpg');
        ";

        $stmt = $conn->prepare($sql);
        $stmt2 = $conn->prepare($sql2);

        $stmt->executeQuery();
        $stmt2->executeQuery();
    }


    // /**
    //  * @return Books[] Returns an array of Books objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Books
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
