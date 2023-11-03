<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRateRequest;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(Request $request)
    {
        // Get all posts using the service
        $posts = $this->postService->getAllPosts($request->user()->id);
        return view('dashboard', [
            "Posts" => $posts
        ])->with('user', auth()->user());
    }

    public function like(Request $request, $postId)
    {
        // Like a post using the service
        $liked = $this->postService->likePost($postId, $request->user()->id);
        return redirect(route('dashboard') . "?page=" . ($request->page ?? 1) . "#post_" . $postId);
    }

    public function save(Request $request, $postId)
    {
        // Like a post using the service
        $saved = $this->postService->savePost($postId, $request->user()->id);
        return redirect(route('dashboard') . "?page=" . ($request->page ?? 1) . "#post_" . $postId);
    }

    public function rate(ValidateRateRequest $request, $postId)
    {
        // Like a post using the service
        $rated = $this->postService->ratePost($postId, $request->user()->id, $request['rate']);
        return redirect(route('dashboard') . "?page=" . ($request->page ?? 1) . "#post_" . $postId);
    }
}
