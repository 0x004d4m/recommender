<?php

namespace App\Contracts\Repositories;

use App\Models\Like;
use App\Models\Rate;

interface InteractionRepositoryInterface
{
    public function count($userId);
    public function list($userId);
    public function handleLikeInteraction(Like $like, $action='add');
    public function createRateInteraction(Rate $rate);
}
