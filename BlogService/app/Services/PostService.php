<?php

namespace App\Services;

use App\Helpers\ResponseHelper;
use App\Repositories\Contract\PostRepositoryInterface;

class PostService
{
    protected $repository;
    public function __construct(PostRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    public function getAll()
    {
        $response = $this->repository->getAll();
        if ($response) {
            return ResponseHelper::success($response);
        }
        return ResponseHelper::error($response);
    }
    public function getById(int $id)
    {
        $response = $this->repository->getById($id);
        if ($response) {
            return ResponseHelper::success($response);
        }
        return ResponseHelper::error($response);
    }
    public function create(array $data)
    {
        $response = $this->repository->create($data);
        if ($response) {
            return ResponseHelper::success($response);
        }
        return ResponseHelper::error($response);
    }
    public function update(array $data, int $id)
    {
        $response = $this->repository->update($data, $id);
        if ($response) {
            return ResponseHelper::success($response);
        }
        return ResponseHelper::error($response);
    }
    public function delete(int $id)
    {
        $response = $this->repository->delete($id);
        if ($response) {
            return ResponseHelper::success($response);
        }
        return ResponseHelper::error($response);
    }
}
