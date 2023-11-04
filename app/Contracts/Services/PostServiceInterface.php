<?php

namespace App\Contracts\Services;

interface PostServiceInterface
{
    public function getPosts(?int $userId);
    public function toggleLikePost($postId, $userId);
    public function ratePost($postId, $userId, $rate);
}
