<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Artist extends Model
{
    protected $fillable = [
        'id',
        'artist_id',
        'name',
        'uri',
        'genres',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'genres' => 'array',
        ];
    }

    public function tracks(): HasMany
    {
        return $this->hasMany(MusicTrack::class);
    }

    public function albums(): HasMany
    {
        return $this->hasMany(Album::class);
    }

}