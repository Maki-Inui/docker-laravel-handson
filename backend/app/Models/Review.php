<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class Review extends Model
{
    protected $table = 'reviews';
    protected $fillable = ['shop_id', 'title', 'comment', 'recommend_score', 'food_score'];
    use HasFactory;

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function userNices()
    {
        return $this->HasMany(Nice::class)->where('user_id', Auth::id());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function photos()
    {
        return $this->HasMany(Photo::class);
    }

    public function has_photo()
    {
        return $this->HasMany(Photo::class)->exists();
    }

    public function main_photo()
    {
        return $this->HasMany(Photo::class)->first();
    }

    public function photos_count()
    {
        return $this->HasMany(Photo::class)->count();
    }
}
