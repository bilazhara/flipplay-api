<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Media extends Model
{
    protected $table = 'media';

    protected $fillable = ['title', 'type', 'year', 'score', 'genres', 'episodes', 'chapters'];

    protected $casts = [
        'genres' => 'array',
        'year'   => 'integer',
        'score'  => 'float',
    ];

    // Satu Media bisa dikoleksi banyak User
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
