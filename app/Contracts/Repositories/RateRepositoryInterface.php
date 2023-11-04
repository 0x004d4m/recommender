<?php

namespace App\Contracts\Repositories;

interface RateRepositoryInterface
{
    public function create($postId, $userId, $rate);
}
