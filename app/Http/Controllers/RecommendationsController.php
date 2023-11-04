<?php

namespace App\Http\Controllers;

use App\Services\RecommendationService;
use App\Services\UserRecommendationHistoryService;
use Illuminate\Http\Request;

class RecommendationsController extends Controller
{
    public function __construct(protected RecommendationService $recommendationService)
    {
    }

    public function index(Request $request)
    {
        // Get all User Recommendation History using the service
        $recommendationHistory = $this->recommendationService->list($request->user()->id);
        return view('recommendation_history', [
            "recommendations" => $recommendationHistory
        ]);
    }
}
