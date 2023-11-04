<?php

namespace App\Contracts\Services;

interface RecommendationServiceInterface
{
    public function list(?int $userId = 0);
}
