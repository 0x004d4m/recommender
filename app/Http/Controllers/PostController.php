<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRateRequest;
use App\Repositories\SaveService;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(protected PostService $postService){}

    public function index(Request $request)
    {
        // Get all posts using the service
        $posts = $this->postService->getPosts($request->user()->id);
        return view('dashboard', [
            "posts" => $posts
        ])->with('user', auth()->user());
    }

    public function like(Request $request, $postId)
    {
        // Like a post using the service
        $liked = $this->postService->toggleLikePost($postId, $request->user()->id);
        return redirect(route('dashboard') . "?page=" . ($request->page ?? 1) . "#post_" . $postId);
    }

    public function rate(ValidateRateRequest $request, $postId)
    {
        // Like a post using the service
        $rated = $this->postService->ratePost($postId, $request->user()->id, $request['rate']);
        return redirect(route('dashboard') . "?page=" . ($request->page ?? 1) . "#post_" . $postId);
    }
}
