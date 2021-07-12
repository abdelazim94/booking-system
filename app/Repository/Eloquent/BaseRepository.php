<?php
namespace App\Repository\Eloquent;

use App\Repository\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements EloquentRepositoryInterface
{
    protected  $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model->with($relations)->get($columns);
    }

    public function paginate($total=5,  array $relations = [])
    {
        return $this->model->with($relations)->paginate($total);
    }

    public function findById(int $modelId, array $columns = ["*"], array $relations = [], $appends=[]): ?Model
    {
        return $this->model->select($columns)->with($relations)->append($appends)->findorFail($modelId);
    }

    public function create(array $payload) : ?Model
    {
        $model = $this->model->create($payload);
        return $model->fresh();
    }

    public function update(int $modelId, array $payload): bool
    {
        $model = $this->findById($modelId);
        return $model->update($payload);
    }

    public function updateWitBind($model, $payload){
        return $model->update($payload);
    }

    public function deleteById(int $modelId): bool
    {
        return $this->findById($modelId)->delete();
    }


}
