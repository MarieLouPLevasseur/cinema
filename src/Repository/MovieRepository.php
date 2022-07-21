<?php

namespace App\Repository;

use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Movie>
 *
 * @method Movie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Movie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Movie[]    findAll()
 * @method Movie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
    }

    public function add(Movie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Movie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

// fonction pour les performances de récupération des collections sur la page show (plutot que les requetes multiples)
    public function findForShow($movieId): ?Movie
    {
         $entityManager = $this->getEntityManager();
         $query = $entityManager->createQuery(
             // ! les alias sont obligatoire ici
             'SELECT m, g, c, p
             FROM App\Entity\Movie m
             JOIN m.genres g
             JOIN m.castings c
             JOIN c.person p
             WHERE m.id = :movie_id
             '
         )->setParameter('movie_id', $movieId);
 
         // returns an array of Product objects
         return $query->getOneOrNullResult();
        }

    // récupération par Ordre des titres ascendant
        public function findByOrderedByTitleAsc()
        {
            $entityManager = $this->getEntityManager();
    
            $query = $entityManager->createQuery(
                'SELECT m
                    FROM App\Entity\Movie m
                ORDER BY m.title ASC
                '
            );
    
            // dump($query->getSQL());
            // returns an array of Product objects
            return $query->getResult();
        }
// récupération avec le query Builder

public function findByOrderedByTitleAscQB()
{
    $query = $this->createQueryBuilder('m')
    // ->from('App\Entity\Movie', 'm') // on n'en n'a pas besoin car on est dans un movie Repository
    ->orderBy('m.title', 'ASC')
                    ->getQuery();

    // dump($query->getSQL());
    // returns an array of Product objects
    return $query->getResult();
}

//    /**
//     * @return Movie[] Returns an array of Movie objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Movie
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
