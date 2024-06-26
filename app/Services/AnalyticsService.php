<?php

namespace App\Services;

use App\Models\Artist;
use App\Models\MusicTrack;
use App\Models\UserAnalytics;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AnalyticsService
{
    public function __construct(
        private readonly UserAnalyticsService $userAnalyticsService,
    ){}

    private function flatenArray(array $array): array
    {
        $result = [];
        foreach ($array as $value) {
            if (is_array($value)) {
                $result = array_merge($result, $this->flatenArray($value));
            } else {
                $result[] = $value;
            }
        }
        return $result;
    }

    public function gatherUserAnalyticsData(): UserAnalytics
    {
        $user = Auth::user();
        $analytics = UserAnalytics::where('user_id', $user->id)->first();
        if ($analytics) {
            return $analytics;
        }
        $avgDuration = MusicTrack::where('user_id', $user->id)->avg('duration');
        $avgAcousticness = MusicTrack::where('user_id', $user->id)->avg('acousticness');
        $avgDanceability = MusicTrack::where('user_id', $user->id)->avg('danceability');
        $avgEnergy = MusicTrack::where('user_id', $user->id)->avg('energy');
        $mostListenedKey = MusicTrack::where('user_id', $user->id)->max('key');
        $avgLoudness = MusicTrack::where('user_id', $user->id)->avg('loudness');
        $mostListenedMode = MusicTrack::where('user_id', $user->id)->max('mode');
        $avgTempo = MusicTrack::where('user_id', $user->id)->avg('tempo');
        $mostListenedTimeSignature = MusicTrack::where('user_id', $user->id)->max('time_signature');
        $avgValence = MusicTrack::where('user_id', $user->id)->avg('valence');

        $musicTracks = MusicTrack::where('user_id', $user->id)->get();
        $listenedGenres = [];

        foreach ($musicTracks as $musicTrack) {
            $artist = $musicTrack->album->artist;
            if (json_decode($artist->genres) !== [] && $artist !== null) {
                $listenedGenres[] = json_decode($artist->genres);
            }
        }

        $mostListenedGenres = $this->flatenArray($listenedGenres);
        $mostListenedGenres = array_count_values($mostListenedGenres );
        $mostListenedGenres = array_slice($mostListenedGenres, 0, 10);

        $mostListenedGenres = array_keys($mostListenedGenres);


        $userAnalyticsData = [
            'user_id' => $user->id,
            'average_duration' => $avgDuration,
            'most_listened_genres' => json_encode($mostListenedGenres),
            'average_acousticness' => $avgAcousticness,
            'average_danceability' => $avgDanceability,
            'average_energy' => $avgEnergy,
            'most_listened_key' => $mostListenedKey,
            'average_loudness' => $avgLoudness,
            'most_listened_mode' => $mostListenedMode,
            'average_tempo' => $avgTempo,
            'most_listened_time_signature' => $mostListenedTimeSignature,
            'average_valence' => $avgValence,
        ];

        $userAnalytics = $this->userAnalyticsService->create($userAnalyticsData);
        $userAnalytics->user()->associate($user);

        return $userAnalytics;
    }
}