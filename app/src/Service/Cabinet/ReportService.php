<?php

declare (strict_types=1);

namespace App\Service\Cabinet;

use App\Entity\Goods;
use App\Entity\User;
use App\Enum\CalculatorPeriodEnum;
use App\Repository\CalculatorRepository;
use App\Repository\GoodsRepository;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportService
{
    public function __construct(
        private readonly CalculatorRepository $calculatorRepository,
        private readonly GoodsRepository $goodsRepository,
    ) {}

    public function getReport(string $reportPeriod): string
    {
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', 'Hello World !');

        $writer = new Xlsx($spreadsheet);
        ob_start();
        $writer->save('php://output');
        $content = ob_get_clean();

        return $content;
    }

    public function getGoodslist(string $reportPeriod, User $user, ?string $manufacturer): string
    {
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', 'Заказчик');
        $activeWorksheet->setCellValue('B1', 'Квартал');
        $activeWorksheet->setCellValue('C1', 'Группа');
        $activeWorksheet->setCellValue('D1', 'Номенклатура');
        $activeWorksheet->setCellValue('E1', 'Условная цена');
        $activeWorksheet->setCellValue('F1', 'Штрихкод');
        $activeWorksheet->setCellValue('G1', 'ЖВНЛП');
        $activeWorksheet->setCellValue('H1', 'Действующее вещество');
        $activeWorksheet->setCellValue('I1', 'Завод');

        /** @var Goods[] $goodsList */
        if (null === $manufacturer) {
            $goodsList = $this->goodsRepository->getFullData($reportPeriod, $user);
        }
        else {
            $goodsList = $this->goodsRepository->findBy([
                'manufacturer' => $manufacturer,
                'period' => CalculatorPeriodEnum::from($reportPeriod)->value,
            ]);
        }

        $rowNum = 2;

        foreach ($goodsList as $goods) {
            $activeWorksheet->setCellValue('A' . $rowNum, $goods->getManufacturer());
            $activeWorksheet->setCellValue('B' . $rowNum, $goods->getQuarter());
            $activeWorksheet->setCellValue('C' . $rowNum, $goods->getGroupGood());
            $activeWorksheet->setCellValue('D' . $rowNum, $goods->getGoods());
            $activeWorksheet->setCellValue('E' . $rowNum, $goods->getPrice());
            $activeWorksheet->setCellValue('F' . $rowNum, $goods->getBarcode());
            $activeWorksheet->setCellValue('G' . $rowNum, $goods->getZvnlp());
            $activeWorksheet->setCellValue('H' . $rowNum, $goods->getSubstance());
            $activeWorksheet->setCellValue('I' . $rowNum, $goods->getFabr());

            $rowNum++;
        }

        $writer = new Xlsx($spreadsheet);
        ob_start();
        $writer->save('php://output');
        $content = ob_get_clean();

        return $content;
    }
}
