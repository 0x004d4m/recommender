<?php

namespace App\Providers;

use App\Models\{
    UserLikedPost,
    UserRatedPost
};
use App\Observers\{
    PostLikesObserver,
    PostRatesObserver
};
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        UserLikedPost::observe(PostLikesObserver::class);
        UserRatedPost::observe(PostRatesObserver::class);
    }
}
