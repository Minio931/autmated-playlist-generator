<?php

namespace App\Services;

use App\Models\Album;
use App\Repositories\AlbumRepository;
use Illuminate\Database\Eloquent\Collection;

class AlbumService
{

    public function __construct(
        protected AlbumRepository $albumRepository
    ){}

    public function all(): Collection
    {
        return $this->albumRepository->all();
    }

    public function create(array $data): Album
    {
        return $this->albumRepository->create($data);
    }

    public function update(array $data, $id): Album
    {
        return $this->albumRepository->update($data, $id);
    }

    public function delete($id): Album
    {
        return $this->albumRepository->delete($id);
    }

    public function find($id): Album
    {
        return $this->albumRepository->find($id);
    }

    public function findOrCreate(array $data, $id): Album
    {
        return $this->albumRepository->findOrCreate($data, $id);
    }
}