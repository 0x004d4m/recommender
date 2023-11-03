<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRecommendationHistory extends Model
{
    use HasFactory;

    protected $table = 'user_recommendation_histories';

    protected $fillable = [
        'user_id',
        'recommendation',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
