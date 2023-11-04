<?php

namespace App\Repositories;

use App\Contracts\Repositories\RateRepositoryInterface;
use App\Models\Rate;

class RateRepository implements RateRepositoryInterface
{
    public function create($postId, $userId, $rate)
    {
        $Rate = Rate::where('user_id', $userId)->where('post_id', $postId)->first();

        if ($Rate) {
            // If post is rated, re-rate the post
            $Rate->update([
                'rate' => $rate
            ]);
            return true;
        } else {
            // If post is not rated, rate the post
            if (Rate::create([
                'user_id' => $userId,
                'post_id' => $postId,
                'rate' => $rate
            ])) {
                return true;
            } else {
                return false;
            }
        }
    }
}
