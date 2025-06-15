<?php

declare (strict_types=1);

namespace App\Controller\Cabinet\PharmaStatic;

use App\Entity\User;
use App\Service\Cabinet\CalculatorService;
use App\Service\Cabinet\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class IndexController extends AbstractController
{
    public function __construct(
        private readonly UserService $userService,
        private readonly CalculatorService $calculatorService,
    ) {}

    #[Route('/cabinet/pharma_statistic/', name: 'cabinet_pharma_statistic')]
    public function __invoke(Request $request): Response
    {
        $reportPeriod = $request->get('report', 'curr');

        /** @var User $user */
        $user = $this->getUser();

        $reportPeriodFromDb = $this->calculatorService->getReportYearAndQuarter($reportPeriod);

        $reportData = $this->calculatorService->getReportData($reportPeriod, $user->getLogin());

        return $this->render('cabinet/pharma_statistic/index.html.twig', [
            'user' => $this->userService->getUser(),
            'pageName' => 'Расчет выполнения АС',
            'reportData' => $reportData,
            'year' => $reportPeriodFromDb['year'],
            'quarter' => $reportPeriodFromDb['quarter'],
            'reportPeriod' => $reportPeriod,
        ]);
    }
}
