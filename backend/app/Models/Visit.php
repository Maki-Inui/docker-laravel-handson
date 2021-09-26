<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $table = 'visits';
    protected $fillable = ['shop_id', 'user_id'];
    use HasFactory;

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

}
