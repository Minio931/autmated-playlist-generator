<?php

namespace App\Services;

use App\Models\UserAnalytics;
use Illuminate\Support\Facades\Log;

class RecommendationsService
{
    private array $options;
    private UserAnalytics $userAnalytics;
    private array $seed_genres;
    public function __construct(
        private readonly AnalyticsService $analyticsService,
        private readonly SpotifyService $spotifyService,
    ){

    }

    private function prepareOptions($limit = 50)
    {
        $this->userAnalytics = $this->analyticsService->gatherUserAnalyticsData();

        $user_genres = json_decode($this->userAnalytics->most_listened_genres);
        $seed_genres = $this->spotifyService->getApi()->getGenreSeeds();
        $this->seed_genres = array_values(array_intersect($user_genres, $seed_genres->genres));



        $this->options = [
            'limit' => 20,
            'market' => 'PL',
            'seed_genres' => $this->seed_genres,
            'target_acousticness' => $this->userAnalytics->average_acousticness,
            'target_danceability' => $this->userAnalytics->average_danceability,
            'target_energy' => $this->userAnalytics->average_energy,
            'target_key' => $this->userAnalytics->most_listened_key,
            'target_loudness' => $this->userAnalytics->average_loudness,
            'target_mode' => $this->userAnalytics->most_listened_mode,
            'target_tempo' => $this->userAnalytics->average_tempo,
            'target_time_signature' => $this->userAnalytics->most_listened_time_signature,
            'target_valence' => $this->userAnalytics->average_valence,
        ];
    }

    public function getRecommendations($limit = 50)
    {
        $this->prepareOptions($limit);
        Log::info(print_r($this->options, true));
        $this->options['limit'] = $limit;
        return $this->spotifyService->getApi()->getRecommendations($this->options);
    }

    public function getRecommendationsForDriving($limit = 50)
    {

        $this->prepareOptions($limit);
        $this->options['limit'] = $limit;
        $this->options['target_tempo'] = min($this->userAnalytics->average_tempo + 20,200);
        $this->options['target_energy'] = min($this->userAnalytics->average_energy + 0.5,1);
        $this->options['target_danceability'] = min($this->userAnalytics->most_listened_key + 0.2,1);



        return $this->spotifyService->getApi()->getRecommendations($this->options);
    }

    public function getRecommendationsForWorkout($limit = 50)
    {

        $this->prepareOptions($limit);
        $this->options['limit'] = $limit;
        $this->options['target_tempo'] = min($this->userAnalytics->average_tempo + 100,220);
        $this->options['target_energy'] = min($this->userAnalytics->average_energy + 0.5,1);
        $this->options['target_danceability'] = min($this->userAnalytics->most_listened_key + 0.4,1);
        $this->options["target_loudness"] = max($this->userAnalytics->average_loudness - 5,-60);
        $this->options['target_time_signature'] = max($this->userAnalytics->most_listened_time_signature,4);
        $this->options['target_valence'] = min($this->userAnalytics->average_valence + 0.2,1);

        $recommendations = $this->spotifyService->getApi()->getRecommendations($this->options);
        return $recommendations;
    }

    public function getRecommendationsForWork($limit = 50)
    {

        $this->prepareOptions($limit);
        $this->options['limit'] = $limit;
        $this->options['target_tempo'] = max($this->userAnalytics->average_tempo - 50,120);
        $this->options['target_energy'] = max($this->userAnalytics->average_energy - 0.5,1);
        $this->options['target_time_signature'] = max($this->userAnalytics->most_listened_time_signature,4);
        $this->options['target_acousticness'] = max($this->userAnalytics->average_acousticness + 0.1,1);

        $recommendations = $this->spotifyService->getApi()->getRecommendations($this->options);
        return $recommendations;
    }

    public function getRecomendationForReading($limit = 50)
    {
        $this->prepareOptions($limit);
        $this->options['limit'] = $limit;
        $this->options['target_tempo'] = min($this->userAnalytics->average_tempo - 20,100);
        $this->options['target_energy'] = max($this->userAnalytics->average_energy - 0.5,0.1);
        $this->options['target_danceability'] = min($this->userAnalytics->most_listened_key + 0.5,1);

        $recommendations = $this->spotifyService->getApi()->getRecommendations($this->options);
        return $recommendations;
    }
}