<?php

namespace App\Contracts\Services;

interface SaveServiceInterface
{
    public function list($userId);
    public function toggle($postId, $userId);
}
