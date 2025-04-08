<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $service;
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
    public function create(RegisterRequest $request)
    {
        $response = $this->service->createUser($request->all());
        return response()->json($response);
    }
    public function getAll()
    {
        return response()->json($this->service->getAll());
    }
}
