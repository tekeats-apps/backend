<?php

namespace App\Repositories\Platform\Extra;

use App\Models\Vendor\Extra;
use App\Repositories\Platform\Extra\ExtraRepositoryInterface;

class ExtraRepository implements ExtraRepositoryInterface
{
    protected $model;

    public function __construct(Extra $extra)
    {
        $this->model = $extra;
    }

    public function getExtras($sortField = 'id', $sortDirection = 'desc')
    {
        return $this->model->orderBy($sortField, $sortDirection);
    }

    public function getExtraById(int $id)
    {
        return $this->model->find($id);
    }

    public function createExtra(array $data)
    {
        return $this->model->create($data);
    }
}
