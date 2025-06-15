<?php

declare (strict_types=1);

namespace App\Controller\Cabinet\ListGoods;

use App\Entity\User;
use App\Service\Cabinet\CalculatorService;
use App\Service\Cabinet\ContractService;
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
        private readonly ContractService $contractService,
    ) {}

    #[Route('/cabinet/pharma_statistic/list_goods', name: 'cabinet_pharma_statistic_list_goods')]
    public function __invoke(Request $request): Response
    {
        $reportPeriod = $request->get('period', 'curr');

        /** @var User $user */
        $user = $this->getUser();

        return $this->render('cabinet/pharma_statistic/list_goods/index.html.twig', [
            'user' => $this->userService->getUser(),
            'reportPeriod' => $reportPeriod,
            'contratList' => $this->contractService->getContractData($user, $reportPeriod),
        ]);
    }
}
