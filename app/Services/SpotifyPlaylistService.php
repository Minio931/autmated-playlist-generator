<?php

namespace App\Services;

class SpotifyPlaylistService
{
    private $spotifyUser;
    public function __construct(
        private readonly SpotifyService $spotifyService,
        private readonly RecommendationsService $recommendationsService,
    ){
        $this->spotifyUser = $this->spotifyService->getUser();
    }

    private function createPlaylist($name, $description, $public = false)
    {
        return $this->spotifyService->getApi()->createPlaylist($this->spotifyUser->id, ['name' => $name, 'description' => $description, 'public' => $public]);
    }

    private function populatePlaylist($playlistId, $tracks)
    {
        $this->spotifyService->getApi()->addPlaylistTracks($playlistId, $tracks);
    }

    public function createPlaylistForDriving()
    {

        $tracks = $this->recommendationsService->getRecommendationsForDriving(20)->tracks;
        $playlist = $this->createPlaylist('Driving', 'Recommended tracks for driving');
        $this->populatePlaylist($playlist->id, array_column($tracks, 'id'));
        return $playlist;
    }

}