<?php

declare (strict_types=1);

namespace App\Controller\Cabinet;

use App\Service\Cabinet\BreadCrumbsService;
use App\Service\Cabinet\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CabinetController extends AbstractController
{
    public function __construct(
        private readonly UserService $userService,
        private readonly BreadCrumbsService $breadCrumbsService,
    ) {}

    #[Route('/cabinet/', name: 'cabinet_homepage')]
    public function __invoke(Request $request): Response
    {
        $path = $request->getPathInfo();

        return $this->render('cabinet/homepage/index.html.twig', [
            'user' => $this->userService->getUser(),
            'breadcrumbs' => $this->breadCrumbsService->getBreadCrumbs($path),
        ]);
    }
}
