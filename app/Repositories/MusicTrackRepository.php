<?php

namespace App\Repositories;

use App\Models\MusicTrack;

class MusicTrackRepository implements MusicTrackRepositoryInterface
{

    public function all()
    {
        return MusicTrack::all();
    }

    public function create(array $data)
    {
        return MusicTrack::create($data);
    }

    public function update(array $data, $id)
    {
        $model = MusicTrack::find($id);
        $model->update($data);
        return $model;
    }

    public function delete($id)
    {
        $model = MusicTrack::find($id);
        $model->delete();
        return $model;
    }

    public function find($id)
    {
        return MusicTrack::where('track_id', $id)->first();
    }
}