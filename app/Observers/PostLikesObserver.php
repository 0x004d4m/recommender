<?php

namespace App\Observers;

use App\Models\Like;
use App\Repositories\InteractionRepository;

class PostLikesObserver
{
    public function __construct(protected InteractionRepository $interactionRepository){}

    public function created(Like $like)
    {
        // Handle the "created" event
        return $this->interactionRepository->handleLikeInteraction($like, 'add');
    }

    public function deleted(Like $like)
    {
        // Handle the "deleted" event
        return $this->interactionRepository->handleLikeInteraction($like, 'delete');
    }
}
