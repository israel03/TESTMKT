<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;
    protected $table = 'books';
    protected $fillable = ['name', 'author', 'category', 'published_date', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
