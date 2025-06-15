<?php

declare (strict_types=1);

namespace App\Service\Cabinet;

use App\Repository\CalculatorRepository;

class CalculatorService
{
    public function __construct(
        private readonly CalculatorRepository $calculatorRepository,
    ) {}

    public function getReportYearAndQuarter(string $reportPeriod): array
    {
        return $this->calculatorRepository->getReportYearAndQuarter($reportPeriod);
    }

    public function getReportData(string $reportPeriod, string $userCode): array
    {
        $reportData = $this->calculatorRepository->getReporData($reportPeriod, $userCode);

        $group1Data = [];
        $group2Data = [];
        $group3Data = [];

        foreach ($reportData as $item) {
            switch ($item['groupId']) {
                case 1:
                    $group1Data[] = $item;

                    break;
                case 2:
                    $group2Data[] = $item;

                    break;
                case 3:
                    $group3Data[] = $item;
            }
        }

        $dataByManufacture = [];

        foreach ($group3Data as $item) {
            $dataByManufacture[$item['manuf']] = $item;
        }

        return [
            'group1' => $group1Data,
            'group2' => $group2Data,
            'dataByManufakture' => $dataByManufacture,
        ];
    }
}
