<?php

namespace App\Repositories;

interface PlaylistRepositoryInterface
{
    public function getAll();
    public function find(int $id);
    public function create(array $playlist);
    public function update(array $playlist, int $id);
    public function delete(int $id);

}