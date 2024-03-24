<?php

namespace App\Repositories\Platform\Tags;

interface TagsRespositoryInterface
{
    public function tagsList($sortField = 'id', $sortDirection = 'desc');
    public function createTag(array $data);
}
