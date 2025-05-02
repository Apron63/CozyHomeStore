<?php

declare (strict_types=1);

namespace App\Service\Site;

use App\Entity\Partner;
use App\Enum\PartnerTypeEnum;
use App\Repository\NewsRepository;
use App\Repository\PartnerRepository;
use App\Repository\ReviewRepository;

class HomepageService
{
    private const string REVIEW_PATH = '/storage/review/';

    public function __construct(
        private readonly ReviewRepository $reviewRepository,
        private readonly NewsRepository $newsRepository,
        private readonly PartnerRepository $partnerRepository,
    ) {}

    public function getReviews(): array
    {
        $result = [];

        $reviews = $this->reviewRepository->findAll();
        foreach ($reviews as $review) {
            $result[] = [
                'picture' => self::REVIEW_PATH . $review->getPicture(),
                'thumbinailPicture' => self::REVIEW_PATH . $review->getThumbinailPicture(),
            ];
        }

        return $result;
    }

    /**
     * @return News[]
     */
    public function getLastNews(): array
    {
        return $this->newsRepository->getLastNews(3);
    }

    public function getPartners(): array
    {
        $allPartners = $this->partnerRepository->findAll();

        $defaultPartners = array_filter(
            $allPartners,
            static fn(Partner $partner) => $partner->getType() === PartnerTypeEnum::Default,
        );

        $infoPartners = array_filter(
            $allPartners,
            static fn(Partner $partner) => $partner->getType() === PartnerTypeEnum::Info,
        );

        return [
            'defaultPartners' => $defaultPartners,
            'infoPartners' => $infoPartners,
        ];
    }
}
