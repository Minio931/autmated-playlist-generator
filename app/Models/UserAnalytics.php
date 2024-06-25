<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAnalytics extends Model
{
    protected $fillable = [
        'user_id',
        'most_listened_genres',
        'average_duration',
        'average_acousticness',
        'average_danceability',
        'average_energy',
        'most_listened_key',
        'average_loudness',
        'most_listened_mode',
        'average_tempo',
        'most_listened_time_signature',
        'average_valence',
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
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}