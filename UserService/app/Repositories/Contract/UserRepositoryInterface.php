<?php

namespace App\Repositories\Contract;

interface UserRepositoryInterface
{
    public function create(array $data);
    public function findById($id);
    public function findByEmail($email);
    public function getAll();
}
