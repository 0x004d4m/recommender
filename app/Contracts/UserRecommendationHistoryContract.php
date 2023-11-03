<?php

namespace App\Contracts;

interface UserRecommendationHistoryContract
{
    public function getAllRecommendationHistory(?int $userId=0);
}
