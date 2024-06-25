<?php

namespace App\Services;

use App\Repositories\UserAnalyticsRepository;

class UserAnalyticsService
{
    public function __construct(
        protected UserAnalyticsRepository $userAnalyticsRepository
    ){}

    public function all()
    {
        return $this->userAnalyticsRepository->all();
    }
    public function create(array $data)
    {
        return $this->userAnalyticsRepository->create($data);
    }

    public function update(array $data, int $id)
    {
        return $this->userAnalyticsRepository->update($data, $id);
    }

    public function delete(int $id)
    {
        return $this->userAnalyticsRepository->delete($id);
    }

    public function find(int $id)
    {
        return $this->userAnalyticsRepository->find($id);
    }
}