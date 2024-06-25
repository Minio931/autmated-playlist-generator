<?php

namespace App\Repositories;

use App\Models\Album;
use Illuminate\Database\Eloquent\Collection;

class AlbumRepository implements AlbumRepositoryInterface
{

    public function all(): Collection
    {
        return Album::all();
    }

    public function create(array $data)
    {
        return Album::create($data);
    }

    public function update(array $data, $id)
    {
        $model = Album::find($id);
        $model->update($data);
        return $model;
    }

    public function delete($id)
    {
        $model = Album::find($id);
        $model->delete();
        return $model;
    }

    public function find($id)
    {
        return Album::findOrFail($id);
    }

    public function findOrCreate(array $data, $id)
    {
        $model = Album::where('album_id', $id)->first();
        if ($model) {
            return $model;
        }
        return Album::create($data);
    }
}