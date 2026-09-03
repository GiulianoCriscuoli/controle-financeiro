<?php

namespace App\Interfaces;

interface BaseInterface
{
    public function all(array $columns = ['*']);
    public function findOne(int $id, array $columns = ['*']);
    public function store(array $data);
    public function update(int $id, array $data);
    public function destroy(int $id): bool;
}
