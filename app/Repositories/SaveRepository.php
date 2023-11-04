<?php

namespace App\Repositories;

use App\Contracts\Repositories\SaveRepositoryInterface;
use App\Models\Save;

class SaveRepository implements SaveRepositoryInterface
{
    public function list($userId)
    {
        return Save::where('user_id', $userId)->paginate(25);
    }

    public function toggle($postId, $userId)
    {
        $Save = Save::where('user_id', $userId)->where('post_id', $postId)->first();

        if ($Save) {
            // If post is saved, unsave the post
            $Save->delete();
            return true;
        } else {
            // If post is not saved, save the post
            if (Save::create([
                'user_id' => $userId,
                'post_id' => $postId
            ])) {
                return true;
            } else {
                return false;
            }
        }
    }
}
