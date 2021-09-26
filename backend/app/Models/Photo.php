<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photos';
    protected $fillable = ['review_id', 'path'];
    use HasFactory;

    public function review()
    {
        return $this->belongsTo(Review::class);
    }
}
