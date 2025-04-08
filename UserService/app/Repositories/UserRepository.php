<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contract\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    protected $model;
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model::create($data);
    }

    public function findById($id)
    {
        return User::find($id);
    }

    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }
    public function getAll()
    {
        return User::all();
    }
}
