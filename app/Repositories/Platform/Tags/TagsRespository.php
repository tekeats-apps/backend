<?php

namespace App\Repositories\Platform\Tags;

use App\Models\Vendor\Tag;

class TagsRespository implements TagsRespositoryInterface
{
    protected Tag $model;

    public function __construct(Tag $tag)
    {
        $this->model = $tag;
    }

    public function createTag(array $data)
    {
        return $this->model->create($data);
    }
}
