<?php

namespace App\Services;

use App\Contracts\Services\SaveServiceInterface;
use App\Repositories\SaveRepository;

class SaveService implements SaveServiceInterface
{
    public function __construct(protected SaveRepository $saveRepository){}

    public function list($userId){
        return $this->saveRepository->list($userId);
    }

    public function toggle($postId, $userId)
    {
        return $this->saveRepository->toggle($postId, $userId);
    }
}
