<?php

namespace App\Services;

class DataTransformerService
{
    public function transformTrackData($track, $analytics): array
    {
        return [
            'track_id' => $track->id,
            'name' => $track->name,
            'duration' => $track->duration_ms,
            'acousticness' => $analytics->acousticness,
            'danceability' => $analytics->danceability,
            'energy' => $analytics->energy,
            'key' => $analytics->key,
            'loudness' => $analytics->loudness,
            'mode' => $analytics->mode,
            'tempo' => $analytics->tempo,
            'time_signature' => $analytics->time_signature,
            'valence' => $analytics->valence,
        ];
    }

    public function trasnformArtistData($artist): array
    {
        return [
            'artist_id' => $artist->id,
            'name' => $artist->name,
            'uri' => $artist->uri,
            'genres' => $artist->genres ?? null,
        ];
    }

    public function transformAlbumData($album): array
    {
        return [
            'album_id' => $album->id,
            'name' => $album->name,
            'release_date' => $album->release_date === '0000' ? $album->release_date  : now()->addYears(2000)->format('Y-m-d H:m:s'),
            'total_tracks' => $album->total_tracks,
        ];
    }

}