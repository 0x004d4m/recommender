<?php

namespace App\Contracts\Repositories;

interface LikeRepositoryInterface
{
    public function toggle($postId, $userId);
}
