<?php

declare (strict_types=1);

namespace App\Command\Import;

use App\Entity\Calculator;
use App\Enum\CalculatorPeriodEnum;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:import:calculator',
    description: 'Import table Calculator From CSV',
)]
class ImportCalculatorCommand
{
    private const int BATCH_SIZE = 50;

    public function __construct(
        private readonly EntityManagerInterface $em,
    ) {}

    public function __invoke(SymfonyStyle $io): int
    {
        $inputCalculator = fopen('./../source/calculator.csv', 'r');

        $batchCount = 1;

        while ($row = fgetcsv($inputCalculator)) {
            $itemCalculator = new Calculator()
                ->setPeriod(CalculatorPeriodEnum::from($row[0]))
                ->setGroupId(match ($row[1]) {
                    'group1' => 1,
                    'group2' => 2,
                    'group3' => 3,
                })
                ->setYear((int) $row[2])
                ->setQuarter((int) $row[3])
                ->setManuf($row[4])
                ->setPharma($row[5])
                ->setPharmaId($row[6])
                ->setDetal($row[7])
                ->setPlan((float) $row[8])
                ->setFact((float) $row[9])
                ->setProc((float) $row[10])
                ->setOstDocupit((float) $row[11])
                ->setFactM1((float) $row[12])
                ->setFactM2((float) $row[13])
                ->setFactM3((float) $row[14])
                ->setUbas((float) $row[15])
                ->setUbasRub((float) $row[16])
                ->setBoasProc((float) $row[17])
                ->setBoasRub((float) $row[18])
                ->setBmasProc((float) $row[19])
                ->setBmasRub((float) $row[20])
                ->setBdasProc((float) $row[21])
                ->setBdasRub((float) $row[22])
                ->setBonusZaPaket((float) $row[23])
                ->setTma((float) $row[24])
                ->setPushBonus((float) $row[25])
                ->setBonusZaOtchet((float) $row[26])
                ->setIbas((float) $row[27])
                ->setBf((float) $row[28])
                ->setBonusKarta((float) $row[29])
                ->setOplataTovarom((float) $row[30])
                ->setOplataAvansom((float) $row[31])
                ->setBonusAsVozm((float) $row[32]);

            $this->em->persist($itemCalculator);
            $batchCount++;

            if (self::BATCH_SIZE === $batchCount) {
                $batchCount = 1;

                $this->em->flush();
                $this->em->clear();
                gc_collect_cycles();
            }
        }

        $this->em->flush();
        $this->em->clear();
        gc_collect_cycles();

        fclose($inputCalculator);
        $io->writeln('Completed');
        return Command::SUCCESS;
    }
}
