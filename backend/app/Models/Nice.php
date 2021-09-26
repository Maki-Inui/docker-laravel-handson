<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Nice extends Model
{
    protected $table = 'nices';
    protected $fillable = ['review_id', 'user_id'];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
