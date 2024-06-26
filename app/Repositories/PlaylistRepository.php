<?php

namespace App\Repositories;

use App\Models\Playlist;

class PlaylistRepository implements PlaylistRepositoryInterface
{
    public function getAll()
    {
        return Playlist::all();
    }

    public function find(int $id)
    {
        return Playlist::find($id);
    }

    public function create(array $playlist)
    {
        return Playlist::create($playlist);
    }

    public function update(array $playlist, int $id)
    {
        return Playlist::find($id)->update($playlist);
    }

    public function delete(int $id)
    {
        return Playlist::find($id)->delete();
    }

}