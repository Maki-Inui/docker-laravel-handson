<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = 'shops';
    protected $fillable = ['name', 'description', 'category_id', 'area_id', 'image', 'recommend_score', 'food_score'];
    use HasFactory;

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->HasMany(Image::class);
    }

    public function has_image()
    {
        return $this->HasMany(Image::class)->exists();
    }

    public function main_image()
    {
        return $this->HasMany(Image::class)->first();
    }

    public function images_count()
    {
        return $this->HasMany(Image::class)->count();
    }

    public function visits()
    {
        return $this->HasMany(Visit::class);
    }
}
