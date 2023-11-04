<?php

namespace App\Http\Controllers;

use App\Services\SaveService;
use Illuminate\Http\Request;

class SaveController extends Controller
{
    public function __construct(protected SaveService $saveService){}

    public function index(Request $request)
    {
        // Get all saved posts using the service
        $posts = $this->saveService->list($request->user()->id);
        return view('save', [
            "posts" => $posts
        ])->with('user', auth()->user());
    }

    public function store(Request $request, $postId)
    {
        // Save a post using the service
        $saved = $this->saveService->toggle($postId, $request->user()->id);
        return redirect(route('dashboard') . "?page=" . ($request->page ?? 1) . "#post_" . $postId);
    }
}
