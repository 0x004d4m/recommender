<?php

namespace App\Providers;

use App\Contracts\Repositories\InteractionRepositoryInterface;
use App\Contracts\Repositories\LikeRepositoryInterface;
use App\Contracts\Repositories\PostRepositoryInterface;
use App\Contracts\Repositories\RateRepositoryInterface;
use App\Contracts\Repositories\RecommendationRepositoryInterface;
use App\Contracts\Repositories\SaveRepositoryInterface;
use App\Contracts\Services\PostServiceInterface;
use App\Contracts\Services\RecommendationServiceInterface;
use App\Contracts\Services\SaveServiceInterface;
use App\Models\{
    Like,
    Rate,
};
use App\Observers\{
    PostLikesObserver,
    PostRatesObserver
};
use App\Repositories\InteractionRepository;
use App\Repositories\LikeRepository;
use App\Repositories\PostRepository;
use App\Repositories\RateRepository;
use App\Repositories\RecommendationRepository;
use App\Repositories\SaveRepository;
use App\Services\PostService;
use App\Services\RecommendationService;
use App\Services\SaveService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Binding repository interfaces to there implementations
        $this->app->bind(InteractionRepositoryInterface::class, InteractionRepository::class);
        $this->app->bind(LikeRepositoryInterface::class, LikeRepository::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(RateRepositoryInterface::class, RateRepository::class);
        $this->app->bind(RecommendationRepositoryInterface::class, RecommendationRepository::class);
        $this->app->bind(SaveRepositoryInterface::class, SaveRepository::class);

        // Binding service interfaces to there implementations
        $this->app->bind(
            PostServiceInterface::class,
            function ($app) {
                return new PostService($app->make(PostRepository::class), $app->make(LikeRepository::class), $app->make(RateRepository::class), $app->make(InteractionRepository::class));
            }
        );
        $this->app->bind(
            RecommendationServiceInterface::class,
            function ($app) {
                return new RecommendationService($app->make(RecommendationRepository::class));
            }
        );
        $this->app->bind(
            SaveServiceInterface::class,
            function ($app) {
                return new SaveService($app->make(SaveRepository::class));
            }
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Like::observe(resolve(PostLikesObserver::class));
        Rate::observe(resolve(PostRatesObserver::class));
    }
}
