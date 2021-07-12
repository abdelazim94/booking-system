<?php
namespace App\Repository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface EloquentRepositoryInterface
{
    public function all(array $columns=['*'], array $relations=[]): Collection;

    public function paginate($total=5,  array $relations = []);

    public function findById(
        int $modelId,
        array $columns=["*"],
        array $relations = [],
        array $appends = []
    ) : ?Model;

    public function create(array $payload): ?Model;

    public function update(int $modelId, array $payload):bool;

    public function deleteById(int $modelId): bool;

    public function updateWitBind($model, $payload);

}
