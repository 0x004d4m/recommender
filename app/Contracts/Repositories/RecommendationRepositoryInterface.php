<?php

namespace App\Contracts\Repositories;

interface RecommendationRepositoryInterface
{
    public function list($userId);
}
