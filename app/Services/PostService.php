<?php

namespace App\Services;

use App\Contracts\PostServiceContract;
use App\Repositories\PostRepository;

class PostService implements PostServiceContract
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAllPosts(?int $userId)
    {
        return $this->postRepository->all($userId);
    }

    public function likePost($postId, $userId)
    {
        return $this->postRepository->toggleLike($postId, $userId);
    }

    public function savePost($postId, $userId)
    {
        return $this->postRepository->toggleSave($postId, $userId);
    }

    public function ratePost($postId, $userId, $rate)
    {
        return $this->postRepository->rate($postId, $userId, $rate);
    }
}

