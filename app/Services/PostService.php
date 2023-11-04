<?php

namespace App\Services;

use App\Contracts\Services\PostServiceInterface;
use App\Repositories\InteractionRepository;
use App\Repositories\LikeRepository;
use App\Repositories\PostRepository;
use App\Repositories\RateRepository;

class PostService implements PostServiceInterface
{
    public function __construct(protected PostRepository $postRepository, protected LikeRepository $likeRepository, protected RateRepository $rateRepository, protected InteractionRepository $interactionRepository)
    {
    }

    public function getPosts(?int $userId)
    {
        if ($this->interactionRepository->count($userId) > 5) {
            return $this->interactionRepository->list($userId);
        }
        return $this->postRepository->list();
    }

    public function toggleLikePost($postId, $userId)
    {
        $this->likeRepository->toggle($postId, $userId);
    }

    public function ratePost($postId, $userId, $rate)
    {
        return $this->rateRepository->create($postId, $userId, $rate);
    }
}
