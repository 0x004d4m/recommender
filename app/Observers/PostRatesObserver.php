<?php

namespace App\Observers;

use App\Models\{
    UserInteraction,
    UserRatedPost
};

class PostRatesObserver
{
    public function created(UserRatedPost $postRate)
    {
        // Handle the post "created" event
        $this->updateUserInteractions($postRate);
    }

    protected function updateUserInteractions(UserRatedPost $postRate)
    {
        // Fetch or create the UserInteraction instance
        $interaction = UserInteraction::firstOrCreate(
            ['user_id' => $postRate->user_id, 'post_id' => $postRate->post_id],
        );

        // Update rate value
        $interaction->rate = $postRate->rate;

        $interaction->save();
    }
}
