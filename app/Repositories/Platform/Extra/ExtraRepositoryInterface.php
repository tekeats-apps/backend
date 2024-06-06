<?php

namespace App\Repositories\Platform\Extra;

interface ExtraRepositoryInterface
{
    public function getExtras($sortField = 'id', $sortDirection = 'desc');
    public function createExtra(array $data);
    public function getExtraById(int $id);
}
