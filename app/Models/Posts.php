<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Comments;

class Posts extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'author',
        'image'
    ];

    public function penulis(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comments::class, 'post_id', 'id');
    }
}
