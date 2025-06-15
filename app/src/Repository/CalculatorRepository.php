<?php

declare (strict_types=1);

namespace App\Repository;

use App\Dto\Cabinet\CalculatorDto;
use App\Entity\Calculator;
use App\Enum\CalculatorPeriodEnum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Calculator>
 */
class CalculatorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Calculator::class);
    }

    public function save(Calculator $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Calculator $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getReportYearAndQuarter(string $reportPeriod): array
    {
        $result = $this->createQueryBuilder('c')
            ->select('c.year, c.quarter')
            ->distinct()
            ->where('c.period = :period')
            ->andWhere('c.pharmaId not in (:testAS, :testApt)')
            ->setParameter('period', CalculatorPeriodEnum::from($reportPeriod))
            ->setParameter('testAS', 'testAS')
            ->setParameter('testApt', 'testApt')
            ->getQuery()
            ->getResult();

        return [
            'year' => $result[0]['year'] ?? '',
            'quarter' => $result[0]['quarter'] ?? '',
        ];
    }

    public function getReporData(string $reportPeriod, string $userCode): array
    {
        return $this->createQueryBuilder('c')
            ->where('c.period = :period')
            ->andWhere('c.pharmaId = :userCode')
            ->setParameter('period', CalculatorPeriodEnum::from($reportPeriod))
            ->setParameter('userCode', $userCode)
            ->getQuery()
            ->getArrayResult();
    }
}
