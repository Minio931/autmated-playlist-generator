<?php

namespace App\Repositories;

use App\Models\Artist;
use App\Models\MusicTrack;

class ArtistRepository implements ArtistRepositoryInterface
{

    public function all()
    {
        return MusicTrack::all();
    }

    public function create(array $data)
    {
        return Artist::create($data);
    }

    public function update(array $data, $id)
    {
        $model = Artist::find($id);
        $model->update($data);
        return $model;
    }

    public function delete($id)
    {
        $model = Artist::find($id);
        $model->delete();
        return $model;
    }

    public function find($id)
    {
        return Artist::findOrFail($id);
    }

    public function findOrCreate(array $data, $id)
    {
        $model = Artist::where('artist_id', $id)->first();
        if(!$model) {
            $model = Artist::create($data);
        }
        return $model;
    }
}