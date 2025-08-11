<?php
namespace App\Repository;

use App\Entity\Evenement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Evenement>
 */
class EvenementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Evenement::class);
    }

    public function findByFilters($categorie, $lieu, $date, $search)
{
    $qb = $this->createQueryBuilder('e');

    if ($categorie) {
        $qb->andWhere('e.categorie = :categorie')
           ->setParameter('categorie', $categorie);
    }
    if ($lieu) {
        $qb->andWhere('e.lieu = :lieu')
           ->setParameter('lieu', $lieu);
    }
    if ($date) {
        $qb->andWhere('DATE(e.date) = :date')
           ->setParameter('date', $date);
    }
    if ($search) {
        $qb->andWhere('e.titre LIKE :search OR e.description LIKE :search')
           ->setParameter('search', '%'.$search.'%');
    }

    return $qb->getQuery()->getResult();
}
}
