<?php

namespace App\Services;

use App\Models\MusicTrack;
use App\Repositories\MusicTrackRepository;

class MusicTrackService
{
    public function __construct(
        protected MusicTrackRepository $musicTrackRepository
    ){}

    public function getAll(): array
    {
        return $this->musicTrackRepository->getAll();
    }

    public function create(array $musicTrack): MusicTrack
    {
        return $this->musicTrackRepository->create($musicTrack);
    }

    public function update(array $musicTrack, $id): MusicTrack
    {
        return $this->musicTrackRepository->update($musicTrack, $id);
    }

    public function delete(array $musicTrack): MusicTrack
    {
        return $this->musicTrackRepository->delete($musicTrack);
    }

    public function find($id): MusicTrack|null
    {
        return $this->musicTrackRepository->find($id);
    }



}