<?php

namespace App\RepositoryInterfaces;

interface PostRepositoryInterface
{
    public function all(?int $userId=0);
    public function toggleLike($postId, $userId);
    public function toggleSave($postId, $userId);
    public function rate($postId, $userId, $rate);
}
