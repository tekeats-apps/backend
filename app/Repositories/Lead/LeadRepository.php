<?php

namespace App\Repositories\Lead;

use App\Models\Lead;
use App\Enums\LeadStatus;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Lead\LeadRepositoryInterface;

class LeadRepository implements LeadRepositoryInterface
{
    public function __construct(protected Lead $model) {}

    public function create(array $data): Lead
    {
        return $this->model->create($data);
    }

    public function find(int $id): ?Lead
    {
        return $this->model->find($id);
    }

    public function update(array $data, int $id): bool
    {
        return $this->model->where('id', $id)->update($data);
    }

    public function delete(int $id): bool
    {
        return $this->model->destroy($id);
    }

    public function getAllByLeads(?LeadStatus $status = null, string $sortBy = 'created_at', string $sortOrder = 'desc'): Collection
    {
        $query = $this->model;

        if ($status !== null) {
            $query = $query->where('status', $status->value);
        }

        return $query->orderBy($sortBy, strtolower($sortOrder))->get();
    }

}
