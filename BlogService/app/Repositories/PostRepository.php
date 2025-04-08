<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Contract\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    protected $model;
    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model::all();
    }

    public function getById($id)
    {
        return $this->model::findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model::create($data);
    }

    public function update(array $data,$id)
    {
        $post = $this->getById($id);
        $post->update($data);
        return $post;
    }

    public function delete($id)
    {
        $post = $this->getById($id);
        return $post->delete();
    }
}
