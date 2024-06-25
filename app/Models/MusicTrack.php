<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class MusicTrack extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'track_id',
        'name',
        'uri',
        'duration',
        'album_id',
        'user_id',
        'acousticness',
        'danceability',
        'energy',
        'key',
        'loudness',
        'mode',
        'tempo',
        'time_signature',
        'valence',
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

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}