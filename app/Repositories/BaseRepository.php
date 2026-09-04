<?php

// app/Repositories/BaseRepository.php
namespace App\Repositories;

use App\Interfaces\BaseInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(array $columns = ['*'])
    {
        return $this->model->select($columns)->get();
    }

    public function findOne(int $id, array $columns = ['*'])
    {
        return $this->model->select($columns)->findOrFail($id);
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        $updateData = $this->findOne($id);
        $updateData->update($data);
        return $updateData;
    }

    public function destroy(int $id): bool
    {
        return $this->findOne($id)->delete();
    }
}
