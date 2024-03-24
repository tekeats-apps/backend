<?php

namespace App\Services\Platform;

use App\Repositories\Platform\Tags\TagsRespository;

class TagService
{
    protected TagsRespository $tagsRespository;

    public function __construct(TagsRespository $tagsRespository)
    {
        $this->tagsRespository = $tagsRespository;
    }
    public function createTag(array $data)
    {
        $category = $this->tagsRespository->createTag($data);
        return $category;
    }

}
