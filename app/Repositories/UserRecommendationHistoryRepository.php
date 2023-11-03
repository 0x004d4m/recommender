<?php

namespace App\Repositories;

use App\Models\{
    UserRecommendationHistory,
};
use App\RepositoryInterfaces\UserRecommendationHistoryRepositoryInterface;

class UserRecommendationHistoryRepository implements UserRecommendationHistoryRepositoryInterface
{
    public function all(?int $userId = 0)
    {
        return UserRecommendationHistory::where('user_id', $userId)->paginate(25);
    }
}
