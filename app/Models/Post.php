<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use CrudTrait, HasFactory, HasFactory;

    protected $fillable = [
        'title',
        'description',
        'keywords',
    ];

    public function getKeywordsAttribute($value)
    {
        return implode(',', json_decode($value));
    }

    public function setKeywordsAttribute($value)
    {
        if(gettype($value)=="array"){
            return $this->attributes['keywords'] = json_encode($value);
        }
        return $this->attributes['keywords'] = json_encode(explode(',', $value));
    }

    public function isLikedByUser(?User $user)
    {
        if (!$user) {
            return false;
        }
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function isSavedByUser(?User $user)
    {
        if (!$user) {
            return false;
        }
        return $this->saves()->where('user_id', $user->id)->exists();
    }

    public function isRatedByUser(?User $user)
    {
        if (!$user) {
            return false;
        }
        return $this->rates()->where('user_id', $user->id)->exists();
    }

    public function getRateByUser(?User $user)
    {
        if (!$user) {
            return false;
        }
        return $this->rates()->where('user_id', $user->id)->first()->rate;
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function saves()
    {
        return $this->hasMany(Save::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }
}
