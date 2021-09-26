<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';
    protected $fillable = ['shop_id', 'user_id'];
    use HasFactory;

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
