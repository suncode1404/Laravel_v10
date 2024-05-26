<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseService
 * @package App\Services
 */
class BaseRepository implements BaseRepositoryInterface
{
    protected  $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function pagination(array $column = ['*'], array $condition = [], array $join = [], int $perpage = 20)
    {
        $query =$this->model->select($column)->where($condition);
        if(!empty($join)) {
            $query->join(...$join);
        }
        return $query->paginate($perpage);
    }
    public function create(array $payload = [])
    {
        $model =  $this->model->create($payload);
        return $model->fresh();
    }
    public function update(int $id = 0, array $payload = [])
    {
        $model = $this->findById($id);
        return $model->update($payload);
    }
    public function delete(int $id = 0)
    {
        return $this->findById($id)->delete();
    }
    public function forceDelete(int $id = 0)
    {
        return $this->findById($id)->forceDelete();
    }
    public function all()
    {
        return $this->model->all();
    }
    public function findById(
        int $modelId,
        array $column = ['*'],
        array $relation = []
    ) {
        return $this->model->select($column)->with($relation)->findOrFail($modelId);
    }
}
