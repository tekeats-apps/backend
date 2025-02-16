<?php

namespace App\Repositories\Lead;

use App\Models\Lead;
use App\Enums\LeadStatus;

interface LeadRepositoryInterface
{
    public function create(array $data);

    public function find(int $id);

    public function delete(int $id);

    public function getAllByLeads(?LeadStatus $status = null, string $sortBy = 'created_at', string $sortOrder = 'desc');
}
