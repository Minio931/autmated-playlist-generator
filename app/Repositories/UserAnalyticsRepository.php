<?php

namespace App\Repositories;

use App\Models\UserAnalytics;

class UserAnalyticsRepository implements UserAnalyticsRepositoryInterface
{
    public function all()
    {
        return UserAnalytics::all();
    }

    public function create(array $data)
    {
        return UserAnalytics::create($data);
    }

    public function update(array $data, int $id)
    {
        $model = UserAnalytics::find($id);
        $model->update($data);
        return $model;
    }

    public function delete(int $id)
    {
        $model = UserAnalytics::find($id);
        $model->delete();
        return $model;
    }

    public function find(int $id)
    {
        return UserAnalytics::firstOrFail($id);
    }
    

}