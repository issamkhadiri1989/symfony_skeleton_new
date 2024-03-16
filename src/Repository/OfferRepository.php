<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Offer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Offer>
 *
 * @method Offer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Offer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Offer[]    findAll()
 * @method Offer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OfferRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Offer::class);
    }

    public function findOffer(string $slugCategory, string $slug): ?Offer
    {
        $qb = $this->createQueryBuilder('o');

        return $qb->join(Category::class, 'c', 'with', 'c = o.category')
            ->where('o.slug = :offerSlug')
            ->andWhere('c.slug = :categorySlug')
            ->setParameter('offerSlug', $slug)
            ->setParameter('categorySlug', $slugCategory)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
