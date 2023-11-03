<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\{
    UserInteraction,
    UserLikedPost,
    UserRatedPost,
    UserRecommendationHistory,
    UserSavedPost
};
use App\RepositoryInterfaces\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    public function all(?int $userId=0)
    {
        // Check if user have enough interactions
        if(UserInteraction::where('user_id', $userId)->where('like', true)->orWhere('rate', '>=', 4)->count()>5){
            return $this->recommendPosts($userId);
        }else{
            return Post::paginate(25);
        }
    }

    public function toggleLike($postId, $userId)
    {
        $UserLikedPost = UserLikedPost::where('user_id', $userId)->where('post_id', $postId)->first();

        if ($UserLikedPost) {
            // If post is liked, unlike the post
            $UserLikedPost->delete();
            return false;
        } else {
            // If post is not liked, like the post
            UserLikedPost::create([
                'user_id' => $userId,
                'post_id' => $postId
            ]);
            return true;
        }
    }

    public function toggleSave($postId, $userId)
    {
        $UserSavedPost = UserSavedPost::where('user_id', $userId)->where('post_id', $postId)->first();

        if ($UserSavedPost) {
            // If post is saved, unsave the post
            $UserSavedPost->delete();
            return false;
        } else {
            // If post is not saved, save the post
            UserSavedPost::create([
                'user_id' => $userId,
                'post_id' => $postId
            ]);
            return true;
        }
    }

    public function rate($postId, $userId, $rate)
    {
        $UserRatedPost = UserRatedPost::where('user_id', $userId)->where('post_id', $postId)->first();

        if ($UserRatedPost) {
            // If post is rated, re-rate the post
            $UserRatedPost->update([
                'rate' => $rate
            ]);
            return true;
        } else {
            // If post is not rated, rate the post
            UserRatedPost::create([
                'user_id' => $userId,
                'post_id' => $postId,
                'rate' => $rate
            ]);
            return true;
        }
        return false;
    }

    public function preferredKeywords($userId)
    {
        return UserInteraction::where('user_id', $userId)
            ->where('like', true)
            ->orWhere('rate', '>=', 4)
            ->with('post')
            ->get()
            ->pluck('post.keywords')
            ->flatten()
            ->countBy()
            ->sortDesc()
            ->keys()
            ->take(4); // Take the top 4 keywords
    }

    public function recommendPosts($userId)
    {
        $keywords = $this->preferredKeywords($userId);
        $posts = Post::query();
        $recommendations=[];
        foreach ($keywords as $keyword) {
            foreach (explode(',', $keyword) as $word) {
                array_push($recommendations, $word);
                $posts->orWhereJsonContains('keywords', $word);
            }
        }

        if(UserRecommendationHistory::where('recommendation', implode(',',$recommendations))->where('user_id', $userId)->count()==0){
            UserRecommendationHistory::create([
                'recommendation' => implode(',',$recommendations),
                'user_id' => $userId
            ]);
        }
        return $posts->paginate(25);;
    }
}
