<?php

namespace App\Repositories\Interfaces;

/**
 * Interface UserServiceInterface
 * @package App\Services\Interfaces
 */
interface BaseRepositoryInterface
{
    public function all();
    public function findById(
        int $modelId,
        array $column = ['*'],
        array $relation = []
    );
    public function create(array $request);
    public function update(int $id = 0, array $payload = []);
    public function delete(int $id = 0);
    public function forceDelete(int $id = 0);
}
