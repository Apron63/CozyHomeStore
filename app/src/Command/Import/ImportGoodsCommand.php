<?php

declare (strict_types=1);

namespace App\Command\Import;

use App\Entity\Goods;
use Doctrine\DBAL\Logging\Middleware;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\NullLogger;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:import:goods',
    description: 'Import table Goods From CSV',
)]
class ImportGoodsCommand
{
    private const int BATCH_SIZE = 5000;

    public function __construct(
        private readonly EntityManagerInterface $em,
    ) {}

    public function __invoke(SymfonyStyle $io): int
    {
        $connection = $this->em->getConnection();
        $connection->getConfiguration()->setMiddlewares([new Middleware(new NullLogger())]);
        $tableName = $this->em->getClassMetadata(Goods::class)->getTableName();
        $data = [];
        $inputGoods = fopen('./../source/goods.csv', 'r');

        $batchCount = 1;
        $cnt = 0;

        while ($row = fgetcsv($inputGoods)) {
            $data[] = [
                'manufacturer' => $row[0],
                'quarter' => $row[1],
                'goods' => $row[2],
                'price' => $row[3],
                'barcode' => $row[4],
                'zvnlp' => $row[5],
                'substance' => $row[6],
                'period' => $row[7],
                'group_good' => $row[8],
                'fabr' => $row[9],
            ];

            $batchCount++;
            $cnt++;

            if (self::BATCH_SIZE < $batchCount) {
                $batchCount = 1;

                $sql = 'INSERT INTO ' . $tableName . ' (manufacturer, quarter, goods, price, barcode, zvnlp, substance, period, group_good, fabr) VALUES ';
                foreach ($data as $item) {
                    $sql .= '("' . $item['manufacturer'] . '","'
                        . $item['quarter'] . '","'
                        . $item['goods'] . '","'
                        . $item['price'] . '","'
                        . $item['barcode'] . '","'
                        . $item['zvnlp'] . '","'
                        . $item['substance'] . '","'
                        . $item['period'] . '","'
                        . $item['group_good'] . '","'
                        . $item['fabr'] . '"),';
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
            $sql = 'INSERT INTO ' . $tableName . ' (manufacturer, quarter, goods, price, barcode, zvnlp, substance, period, group_good, fabr) VALUES ';
            foreach ($data as $item) {
                $sql .= '("' . $item['manufacturer'] . '","'
                    . $item['quarter'] . '","'
                    . $item['goods'] . '","'
                    . $item['price'] . '","'
                    . $item['barcode'] . '","'
                    . $item['zvnlp'] . '","'
                    . $item['substance'] . '","'
                    . $item['period'] . '","'
                    . $item['group_good'] . '","'
                    . $item['fabr'] . '"),';
            }
            $sql = rtrim($sql, ',');

            $result = $connection->executeStatement($sql);
            $io->writeln('Added: ' . $cnt);
        }

        fclose($inputGoods);
        $io->writeln('Completed');
        return Command::SUCCESS;
    }
}
