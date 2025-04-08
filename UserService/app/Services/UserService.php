<?php

namespace App\Services;

use App\Helpers\ResponseHelper;
use App\Repositories\Contract\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $repository;
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    public function createUser(array $userData)
    {
        $userData['password'] = Hash::make($userData['password']);
        $response = $this->repository->create($userData);
        $response['token'] = $response->createToken('token')->accessToken;
        if ($response) {
            return ResponseHelper::success($response,"Kullanıcı başarıyla oluşturuldu",200);
        }
        return ResponseHelper::error("Opss! Bir hata oluştu");
    }
    public function getById(int $id)
    {
        return ResponseHelper::success($this->repository->findById($id),"list",200);
    }
    public function getUserByEmail(string $email)
    {
        return ResponseHelper::success($this->repository->findByEmail($email),"list",200);
    }

    public function getAll()
    {
        return ResponseHelper::success($this->repository->getAll(),"list",200);

    }
}
