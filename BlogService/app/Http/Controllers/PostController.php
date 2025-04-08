<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRequest;
use App\Http\Requests\UpdateRequest;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $service;

    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    public function getAll()
    {
        $posts = $this->service->getAll();
        return response()->json($posts);
    }

    public function create(CreateRequest $request)
    {
        $post = $this->service->create($request->all());
        return response()->json($post);
    }

    public function getById($id)
    {
        $post = $this->service->getById($id);
        return response()->json($post);
    }

    public function update(UpdateRequest $request, $id)
    {
        $post = $this->service->update($request->all(),$id);
        return response()->json($post);
    }

    public function destroy($id)
    {
        $response = $this->service->delete($id);
        return response()->json($response);
    }
}
