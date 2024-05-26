<?php

namespace App\Repositories\Interfaces;

/**
 * Interface UserServiceInterface
 * @package App\Services\Interfaces
 */
interface UserRepositoryInterface
{
    public function getAllPaginate();
    public function create(array $request);

    public function findById(
        int $modelId,
        array $column = ['*'],
        array $relation = []
    );
}
