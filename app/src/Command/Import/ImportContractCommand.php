<?php

declare (strict_types=1);

namespace App\Command\Import;

use App\Entity\Contract;
use Doctrine\DBAL\Logging\Middleware;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\NullLogger;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:import:contract',
    description: 'Import table Contract From CSV',
)]
class ImportContractCommand
{
    private const int BATCH_SIZE = 5000;

    public function __construct(
        private readonly EntityManagerInterface $em,
    ) {}

    public function __invoke(SymfonyStyle $io): int
    {
        $connection = $this->em->getConnection();
        $connection->getConfiguration()->setMiddlewares([new Middleware(new NullLogger())]);
        $tableName = $this->em->getClassMetadata(Contract::class)->getTableName();
        $data = [];
        $inputContract = fopen('./../source/contracts.csv', 'r');

        $batchCount = 1;
        $cnt = 0;

        while ($row = fgetcsv($inputContract)) {
            $data[] = [
                'manufacturer' => $row[0],
                'login_pharma' => $row[1],
                'period' => $row[2],
            ];

            $batchCount++;
            $cnt++;

            if (self::BATCH_SIZE < $batchCount) {
                $batchCount = 1;

                $sql = 'INSERT INTO ' . $tableName . ' (manufacturer, login_pharma, period) VALUES ';
                foreach ($data as $item) {
                    $sql .= '("' . $item['manufacturer'] . '","' . $item['login_pharma'] . '","' . $item['period'] . '"),';
                }
                $sql = rtrim($sql, ',');

                $result = $connection->executeStatement($sql);
                $io->writeln('Added: ' . $cnt);
                $data = [];

                gc_collect_cycles();
                gc_mem_caches();
            }
        }

        if (!empty($data)) {
            $sql = 'INSERT INTO ' . $tableName . ' (manufacturer, login_pharma, period) VALUES ';

            foreach ($data as $item) {
                $sql .= '("' . $item['manufacturer'] . '","' . $item['login_pharma'] . '","' . $item['period'] . '"),';
            }
            $sql = rtrim($sql, ',');

            $result = $connection->executeStatement($sql);
            $io->writeln('Added: ' . $cnt);
        }

        fclose($inputContract);
        $io->writeln('Completed');
        return Command::SUCCESS;
    }
}
