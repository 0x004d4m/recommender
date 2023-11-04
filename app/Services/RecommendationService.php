<?php

namespace App\Services;

use App\Contracts\Services\RecommendationServiceInterface;
use App\Repositories\RecommendationRepository;

class RecommendationService implements RecommendationServiceInterface
{
    public function __construct(protected RecommendationRepository $recommendationRepository){}

    public function list(?int $userId = 0)
    {
        return $this->recommendationRepository->list($userId);
    }
}
