<?php

declare (strict_types=1);

namespace App\Controller\Site;

use App\Service\Common\OptionsService;
use App\Service\Site\ComponentFooterService;
use App\Service\Site\HomepageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomepageController extends AbstractController
{
    public function __construct(
        private readonly HomepageService $homepageService,
        private readonly ComponentFooterService $componentFooterService,
        private readonly OptionsService $optionsService,
    ) {}

    #[Route('/', name: 'app_homepage')]
    public function __invoke(): Response
    {
        $partners = $this->homepageService->getPartners();

        return $this->render('site/homepage/index.html.twig', [
            'reviews' => $this->homepageService->getReviews(),
            'news' => $this->homepageService->getLastNews(),
            'defaultPartners' => $partners['defaultPartners'],
            'infoPartners' => $partners['infoPartners'],
            'footerMenu' => $this->componentFooterService->getContactMeny(),
            'ya_metrika' => $this->optionsService->getOption('ya_metrika'),
        ]);
    }
}
