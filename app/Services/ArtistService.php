<?php

namespace App\Services;

use App\Models\Artist;
use App\Repositories\ArtistRepository;
use Illuminate\Database\Eloquent\Collection;

class ArtistService
{
    public function __construct(
        protected ArtistRepository $artistRepository
    ){}

    public function all() : Collection
    {
        return $this->artistRepository->all();
    }
    public function create(array $data): Artist
    {
        return $this->artistRepository->create($data);
    }

    public function update(array $data, $id): Artist
    {
        return $this->artistRepository->update($data, $id);
    }

    public function delete($id): Artist
    {
        return $this->artistRepository->delete($id);
    }

    public function find($id): Artist
    {
        return $this->artistRepository->find($id);
    }

    public function findOrCreate(array $data, $id): Artist
    {
        return $this->artistRepository->findOrCreate($data, $id);
    }

}