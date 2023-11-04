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
            return true;
        } else {
            // If post is not liked, like the post
            if(Like::create([
                'user_id' => $userId,
                'post_id' => $postId
            ])){
                return true;
            }else{
                return false;
            }
        }
    }
}
