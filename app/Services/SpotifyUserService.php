<?php

namespace App\Services;

use App\Exceptions\SpotifyAccessTokenNotSetException;
use App\Models\Album;
use App\Models\Artist;
use App\Models\MusicTrack;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SpotifyUserService extends SpotifyService
{
    public function __construct(
        private readonly AlbumService $albumService,
        private readonly ArtistService $artistService,
        private readonly MusicTrackService $musicTrackService,
        private readonly DataTransformerService $dataTransformerService
    ){}


    private function getTrackAnalytics(string $track_id)
    {
        try {
            return $this->getApi()->getAudioFeatures($track_id);
        } catch (Exception $e) {
           return null;
        }
    }


    private function addTracksWithAlbumsAndArtists($tracks, $user): array
    {
        $createdTracks = [];

        foreach ($tracks as $track) {
            $musicTrack = $this->musicTrackService->find($track->id);
            if ($musicTrack !== null) {
                continue;
            }

            $track->analytics = $this->getTrackAnalytics($track->id);
            if ($track->analytics === null) {
                continue;
            }
            $data = $this->dataTransformerService->transformTrackData($track, $track->analytics);

            $musicTrack = $this->musicTrackService->create($data);

            $albumData = $this->dataTransformerService->transformAlbumData($track->album);
            $album = $this->albumService->findOrCreate($albumData, $track->album->id);

            $artistData  = $this->dataTransformerService->trasnformArtistData($track->artists[0]);
            $artist = $this->artistService->findOrCreate($artistData, $track->artists[0]->id);

            $album->artist()->associate($artist);
            $musicTrack->album()->associate($album);
            $musicTrack->user()->associate($user);

            $album->save();
            $musicTrack->save();


            $createdTracks[] = $musicTrack;
        }

        return $createdTracks;
    }

    private function getUserPlaylistsIds(int $limit = 50, int $offset = 0): array
    {
        $data = $this->getApi()->getMyPlaylists(["limit" => $limit, "offset" => $offset]);
        $playlists = array_column($data->items, 'id');
        $savedPlaylists = [];


        if ($data->next !== null) {
            $url = parse_url($data->next);
            parse_str($url['query'], $params);
            $offset = $offset + $limit;
            $limit = $params['limit'];

            $savedPlaylists = $this->getUserPlaylistsIds($limit, $offset, $playlists);
        }


        $playlists = array_merge($playlists, $savedPlaylists);
        return $playlists;
    }

    private function getUserPlaylistsTracks(string $playlist_id, int $limit = 50, int $offset = 0, string $market = 'PL', array $savedTracks = []): array
    {
        $data = $this->getApi()->getPlaylistTracks($playlist_id, ["limit" => $limit, "offset" => $offset, "market" => $market]);
        $tracks = array_column($data->items, 'track');
        $savedTracks = [];

        if ($data->next !== null) {
            $url = parse_url($data->next);
            parse_str($url['query'], $params);
            $offset = $offset + $limit;
            $limit = $params['limit'];

            $savedTracks = $this->getUserPlaylistsTracks($playlist_id, $limit, $offset, $market, $tracks);
        }

        $tracks = array_merge($tracks, $savedTracks);
        return $tracks;
    }

    private function getArtistsGenres(Artist $artist): array
    {
        $genres = $this->getApi()->getArtist($artist->artist_id)->genres;

        return $genres;
    }

    /**
     * @throws SpotifyAccessTokenNotSetException
     */
    public function getUsersTopTracks(string $type = 'tracks', string $time_range = 'medium_term', int $limit = 20, int $offset = 0): array
    {
        $tracks = $this->getApi()->getMyTop($type, ['limit' => $limit, 'offset' => $offset, 'time_range' => $time_range])->items;
        $user = Auth::user();

        return $this->addTracksWithAlbumsAndArtists($tracks, $user);
    }

    /**
     * @throws SpotifyAccessTokenNotSetException
     */
    public function getUserSavedTracks(string $market = 'PL', int $limit = 50, int $offset = 0, array $savedTracks = []): array
    {
        $data = $this->getApi()->getMySavedTracks(['limit' => $limit, 'offset' => $offset, 'market' => $market]);
        $tracks = array_merge(array_column($data->items, 'track'), $savedTracks);
        $user = Auth::user();

        $createdTracks[] = $this->addTracksWithAlbumsAndArtists($tracks, $user);


        if ($data->next !== null) {
            $url = parse_url($data->next);
            parse_str($url['query'], $params);
            $offset = $offset + $limit;
            $limit = $params['limit'];
            $market = $params['market'];

            $this->getUserSavedTracks($market, $limit, $offset, $tracks);
        }

        return $createdTracks;
    }


    public function getUserTracksFromPlaylists(string $market = 'PL', int $limit = 50, int $offset = 0): array
    {
        $playlistsIds = $this->getUserPlaylistsIds($limit, $offset);
        $tracks = [];
        $user = Auth::user();

        foreach ($playlistsIds as $playlistId) {
            $tracks = array_merge($tracks, $this->getUserPlaylistsTracks($playlistId, $limit, $offset, $market));
        }

        $createdTracks[] = $this->addTracksWithAlbumsAndArtists($tracks, $user);

        return $createdTracks;
    }

    public function updateArtistsGenres(){
        $artists = Artist::all();
        foreach ($artists as $artist) {
            if ($artist->genres === null) {
                $artist->genres = $this->getArtistsGenres($artist);
                $artist->save();
            }
        }

        return Artist::all();
    }


}