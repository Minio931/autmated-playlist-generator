<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class SpotifyPlaylistService
{
    private $spotifyUser;
    public function __construct(
        private readonly SpotifyService $spotifyService,
        private readonly RecommendationsService $recommendationsService,
        private readonly PlaylistService $playlistService,
    ){
        $this->spotifyUser = $this->spotifyService->getUser();
    }

    private function createPlaylist($name, $description, $public = false)
    {
        $user = Auth::user();
        $playlist = $this->spotifyService->getApi()->createPlaylist($this->spotifyUser->id, ['name' => $name, 'description' => $description, 'public' => $public]);
        $this->playlistService->create(['user_id' => $user->id, 'name' => $name, 'description' => $description, 'spotify_id' => $playlist->id, 'url' => $playlist->external_urls->spotify]);
        return $playlist;
    }

    private function populatePlaylist($playlistId, $tracks)
    {
        $this->spotifyService->getApi()->addPlaylistTracks($playlistId, $tracks);
    }

    public function createPlaylistForDriving()
    {

        $tracks = $this->recommendationsService->getRecommendationsForDriving(50)->tracks;
        $playlist = $this->createPlaylist('Driving', 'Recommended tracks for driving', true);

        $this->populatePlaylist($playlist->id, array_column($tracks, 'id'));
        return $playlist;
    }

    public function createPlaylistForWorking()
    {
        $tracks = $this->recommendationsService->getRecommendationsForWork(50)->tracks;
        $playlist = $this->createPlaylist('Working', 'Recommended tracks for working', true);
        $this->populatePlaylist($playlist->id, array_column($tracks, 'id'));
        return $playlist;
    }

    public function createPlaylistForReading()
    {
        $tracks = $this->recommendationsService->getRecomendationForReading(50)->tracks;
        $playlist = $this->createPlaylist('Reading', 'Recommended tracks for reading', true);
        $this->populatePlaylist($playlist->id, array_column($tracks, 'id'));
        return $playlist;
    }

    public function createPlaylistForWorkout()
    {
        $tracks = $this->recommendationsService->getRecommendationsForWorkout(50)->tracks;
        $playlist = $this->createPlaylist('Workout', 'Recommended tracks for workout', true);
        $this->populatePlaylist($playlist->id, array_column($tracks, 'id'));
        return $playlist;
    }

    public function createPlaylistFromRecommendations()
    {
        $tracks = $this->recommendationsService->getRecommendations(50)->tracks;
        $playlist = $this->createPlaylist('Recommendations', 'Recommended tracks', false);
        $this->populatePlaylist($playlist->id, array_column($tracks, 'id'));
        return $playlist;
    }

}