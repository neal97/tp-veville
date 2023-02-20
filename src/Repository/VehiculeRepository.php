<?php

namespace App\Repository;

use App\Entity\Vehicule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Vehicule>
 *
 * @method Vehicule|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vehicule|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vehicule[]    findAll()
 * @method Vehicule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehiculeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vehicule::class);
    }

    public function save(Vehicule $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Vehicule $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    

    public function findVehiculesAndAgences()
{
    return $this->createQueryBuilder('v')
        ->select('v.id as idVehicule', 'a.id as idAgence','v.photo', 'v.marque', 'v.modele', 'v.description', 'v.prix_journalier as prix', 'a.ville')
        ->innerJoin('App\Entity\Agences', 'a', Join::WITH , 'a.id = v.id_agence')
        ->getQuery()
        ->getResult();
}

public function findVehiculeByIdAgence($idAgence)
{
    return $this->createQueryBuilder('v')
    ->select('v.id as idVehicule', 'a.id as idAgence','v.photo', 'v.marque', 'v.modele', 'v.description', 'v.prix_journalier as prix', 'a.ville')
    ->innerJoin('App\Entity\Agences', 'a', Join::WITH , 'a.id = v.id_agence')
    ->andWhere('a.id = :val')
    ->setParameter('val', $idAgence)
    ->getQuery()
    ->getResult();
}

//    /**
//     * @return Vehicule[] Returns an array of Vehicule objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Vehicule
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
