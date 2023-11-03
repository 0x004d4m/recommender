<?php

namespace App\Services;

use App\Contracts\UserRecommendationHistoryContract;
use App\Repositories\UserRecommendationHistoryRepository;

class UserRecommendationHistoryService implements UserRecommendationHistoryContract
{
    protected $RecommendationHistoryRepository;

    public function __construct(UserRecommendationHistoryRepository $RecommendationHistoryRepository)
    {
        $this->RecommendationHistoryRepository = $RecommendationHistoryRepository;
    }

    public function getAllRecommendationHistory(?int $userId=0)
    {
        return $this->RecommendationHistoryRepository->all($userId);
    }
}
