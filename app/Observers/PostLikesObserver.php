<?php

namespace App\Observers;

use App\Models\{
    UserInteraction,
    UserLikedPost
};

class PostLikesObserver
{
    public function created(UserLikedPost $postLike)
    {
        // Handle the "created" event
        $this->updateUserInteractions($postLike);
    }

    public function deleted(UserLikedPost $postLike)
    {
        // Handle the "deleted" event
        $this->updateUserInteractions($postLike, 'delete');
    }

    protected function updateUserInteractions(UserLikedPost $postLike, $action = 'add')
    {
        // Fetch or create the UserInteraction instance
        $interaction = UserInteraction::firstOrCreate(
            [
                'user_id' => $postLike->user_id,
                'post_id' => $postLike->post_id
            ]
        );

        // Update interactions count
        if ($action === 'add') {
            $interaction->like = true;
        } elseif ($action === 'delete') {
            $interaction->like = false;
        }

        $interaction->save();
    }
}
