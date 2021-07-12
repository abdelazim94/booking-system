<?php
namespace App\Repository\Eloquent;

use App\Models\Doctor;
use App\Repository\ServiceRepositoryInterface;

class DoctorRepository extends BaseRepository implements ServiceRepositoryInterface
{
    protected $model;

    public function __construct(Doctor $model)
    {
        $this->model = $model;
    }
}
