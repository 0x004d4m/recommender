<?php

namespace App\Observers;

use App\Models\Rate;
use App\Repositories\InteractionRepository;

class PostRatesObserver
{
    public function __construct(protected InteractionRepository $interactionRepository){}

    public function created(Rate $postRate)
    {
        // Handle the post "created" event
        return $this->interactionRepository->createRateInteraction($postRate);
    }
}
