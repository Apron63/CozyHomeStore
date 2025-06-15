<?php

declare (strict_types=1);

namespace App\Repository;

use App\Entity\Contract;
use App\Entity\Goods;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Goods>
 */
class GoodsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Goods::class);
    }

    /**
     * @return Goods[]
     */
    public function getFullData(string $reportPeriod, User $user): array
    {
        return
            $this->createQueryBuilder('g')
            // ->select('
            //     g.manufacturer,
            //     g.quarter,
            //     g.goods,
            //     g.price,
            //     g.barcode,
            //     g.zvnlp,
            //     g.substance,
            //     g.groupGood,
            //     g.fabr')
            ->join(
                Contract::class,
                'c',
                Join::WITH,
                'g.manufacturer=c.manufacturer and g.period=c.period and g.period = :reportPeriod and c.loginPharma = :login'
            )
            ->setParameter('reportPeriod', $reportPeriod)
            ->setParameter('login', $user->getLogin())
            ->getQuery()
            ->getResult();
    }
}
