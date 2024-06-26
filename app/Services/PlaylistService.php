<?php

namespace App\Services;

use App\Repositories\PlaylistRepository;

class PlaylistService
{
    public function __construct(
        private readonly PlaylistRepository $playlistRepository
    ){}

    public function getAll()
    {
        return $this->playlistRepository->getAll();
    }

    public function find(int $id)
    {
        return $this->playlistRepository->find($id);
    }

    public function create(array $playlist)
    {
        return $this->playlistRepository->create($playlist);
    }

    public function update(array $playlist, int $id)
    {
        return $this->playlistRepository->update($playlist, $id);
    }

    public function delete(int $id)
    {
        return $this->playlistRepository->delete($id);
    }

}