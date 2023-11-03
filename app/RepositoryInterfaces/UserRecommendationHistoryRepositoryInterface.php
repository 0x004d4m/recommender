<?php

namespace App\RepositoryInterfaces;

interface UserRecommendationHistoryRepositoryInterface
{
    public function all(?int $userId=0);
}
