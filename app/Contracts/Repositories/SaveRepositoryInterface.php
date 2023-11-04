<?php

namespace App\Contracts\Repositories;


interface SaveRepositoryInterface
{
    public function list($userId);
    public function toggle($postId, $userId);
}
