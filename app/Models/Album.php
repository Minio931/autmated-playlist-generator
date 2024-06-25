<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Album extends Model
{

    protected $fillable = [
        'id',
        'album_id',
        'name',
        'total_tracks',
        'release_date',
        'artist_id',
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
            'release_date' => 'date',
        ];
    }

    public function tracks(): HasMany
    {
        return $this->hasMany(MusicTrack::class);
    }

    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }

}