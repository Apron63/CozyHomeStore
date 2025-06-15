<?php

declare (strict_types=1);

namespace App\Controller\Cabinet\PharmaStatic;

use App\Entity\User;
use App\Service\Cabinet\CalculatorService;
use App\Service\Cabinet\ReportService;
use App\Service\Cabinet\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DownloadController extends AbstractController
{
    public function __construct(
        private readonly UserService $userService,
        private readonly CalculatorService $calculatorService,
        private readonly ReportService $reportService,
    ) {}

    #[Route('/cabinet/pharma_statistic/download/', name: 'cabinet_pharma_statistic_download')]
    public function __invoke(Request $request): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $reportPeriod = $request->get('reportPeriod');
        $reportPeriodFromDb = $this->calculatorService->getReportYearAndQuarter($reportPeriod);

        $content = $this->reportService->getReport($reportPeriod);
        $filename = 'Расчет выполнения условий в эксель ' . $reportPeriodFromDb['quarter'] . ' квартал ' . $reportPeriodFromDb['year'] . ' (' . $user->getLogin() . ').xlsx';

        $response = new Response($content);
        $disposition = HeaderUtils::makeDisposition(HeaderUtils::DISPOSITION_ATTACHMENT, $filename, 'filename.xlsx');
        $response->headers->set('Content-Disposition', $disposition);

        return $response;
    }
}
