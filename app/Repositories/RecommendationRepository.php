<?php

namespace App\Repositories;

use App\Contracts\Repositories\RecommendationRepositoryInterface;
use App\Models\Recommendation;

class RecommendationRepository implements RecommendationRepositoryInterface
{
    public function list($userId)
    {
        return Recommendation::where('user_id', $userId)->paginate(25);
    }
}
