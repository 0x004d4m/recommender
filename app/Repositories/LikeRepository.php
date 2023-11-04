<?php

namespace App\Repositories;

use App\Contracts\Repositories\LikeRepositoryInterface;
use App\Models\Like;

class LikeRepository implements LikeRepositoryInterface
{
    public function toggle($postId, $userId)
    {
        $Like = Like::where('user_id', $userId)->where('post_id', $postId)->first();

        if ($Like) {
            // If post is liked, unlike the post
            $Like->delete();
            return false;
        } else {
            // If post is not liked, like the post
            Like::create([
                'user_id' => $userId,
                'post_id' => $postId
            ]);
            return true;
        }
    }
}
