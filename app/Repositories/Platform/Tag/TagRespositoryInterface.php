<?php

namespace App\Repositories\Platform\Tag;

interface TagRespositoryInterface
{
    public function tagsList($sortField = 'id', $sortDirection = 'desc');
    public function createTag(array $data);
}
