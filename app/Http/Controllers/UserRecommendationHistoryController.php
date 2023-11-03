<?php

namespace App\Http\Controllers;

use App\Services\UserRecommendationHistoryService;
use Illuminate\Http\Request;

class UserRecommendationHistoryController extends Controller
{
    protected $RecommendationHistoryService;

    public function __construct(UserRecommendationHistoryService $RecommendationHistoryService)
    {
        $this->RecommendationHistoryService = $RecommendationHistoryService;
    }

    public function index(Request $request)
    {
        // Get all User Recommendation History using the service
        $RecommendationHistory = $this->RecommendationHistoryService->getAllRecommendationHistory($request->user()->id);
        return view('recommendation_history', [
            "Recommendations" => $RecommendationHistory
        ]);
    }
}
