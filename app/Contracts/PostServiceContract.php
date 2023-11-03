<?php

namespace App\Contracts;

interface PostServiceContract
{
    public function getAllPosts(?int $userId);
    public function likePost($postId, $userId);
    public function savePost($postId, $userId);
    public function ratePost($postId, $userId, $rate);
}
