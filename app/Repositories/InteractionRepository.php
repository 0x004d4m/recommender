<?php

namespace App\Repositories;

use App\Contracts\Repositories\InteractionRepositoryInterface;
use App\Models\Interaction;
use App\Models\Like;
use App\Models\Post;
use App\Models\Rate;
use App\Models\Recommendation;

class InteractionRepository implements InteractionRepositoryInterface
{
    public function count($userId)
    {
        return Interaction::where('user_id', $userId)->where('like', true)->orWhere('rate', '>=', 4)->count();
    }

    public function list($userId)
    {
        return $this->recommendPosts($userId);
    }

    public function handleLikeInteraction(Like $like, $action='add')
    {
        // Fetch or create the Interaction instance
        $interaction = Interaction::firstOrCreate(
            [
                'user_id' => $like->user_id,
                'post_id' => $like->post_id
            ]
        );

        // Update interaction like value
        if ($action === 'add') {
            $interaction->like = true;
        } elseif ($action === 'delete') {
            $interaction->like = false;
        }

        $interaction->save();
    }

    public function createRateInteraction(Rate $rate)
    {
        // Fetch or create the UserInteraction instance
        $interaction = Interaction::firstOrCreate(
            ['user_id' => $rate->user_id, 'post_id' => $rate->post_id],
        );

        // Update rate value
        $interaction->rate = $rate->rate;

        $interaction->save();
    }

    private function preferredKeywords($userId)
    {
        return Interaction::where('user_id', $userId)
            ->where('like', true)
            ->orWhere('rate', '>=', 4)
            ->with('post')
            ->get()
            ->pluck('post.keywords')
            ->flatten()
            ->countBy()
            ->sortDesc()
            ->keys()
            ->take(4); // Take the top 4 jsons = 12 keywords
    }

    private function recommendPosts($userId)
    {
        $keywords = $this->preferredKeywords($userId);
        $posts = Post::query();
        $recommendations = [];
        foreach ($keywords as $keyword) {
            foreach (explode(',', $keyword) as $word) {
                array_push($recommendations, $word);
                $posts->orWhereJsonContains('keywords', $word);
            }
        }

        if (Recommendation::where('recommendation', implode(',', $recommendations))->where('user_id', $userId)->count() == 0) {
            Recommendation::create([
                'recommendation' => implode(',', $recommendations),
                'user_id' => $userId
            ]);
        }
        return $posts->paginate(25);;
    }
}
