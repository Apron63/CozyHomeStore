<?php

declare (strict_types=1);

namespace App\Service\Site;

use App\Repository\NewsRepository;
use App\Repository\ReviewRepository;

class HomepageService
{
    private const string REVIEW_PATH = '/storage/review/';

    public function __construct(
        private readonly ReviewRepository $reviewRepository,
        private readonly NewsRepository $newsRepository,
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

    public function getLastNews(): array
    {
        $result = [];

        $reviews = $this->newsRepository->getLastNews(3);
        foreach ($reviews as $review) {
            $result[] = [
                'picture' => self::REVIEW_PATH . $review->getPicture(),
                'thumbinailPicture' => self::REVIEW_PATH . $review->getThumbinailPicture(),
            ];
        }

        return $result;
    }
}
