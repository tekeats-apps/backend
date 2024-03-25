<?php

namespace App\Services\Platform;

use App\Repositories\Platform\Tag\TagRespository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Vendor\Tag;

class TagService
{
    protected TagRespository $tagRespository;

    public function __construct(TagRespository $tagRespository)
    {
        $this->tagRespository = $tagRespository;
    }
    public function getTagsList()
    {
        return $this->tagRespository->tagsList();
    }
    public function getTagDetails($tagId)
    {
        return $this->tagRespository->findTag($tagId);
    }
    public function createTag(array $data)
    {
        $category = $this->tagRespository->createTag($data);
        return $category;
    }
    /**
     * @throws \Exception
     */
    public function updateTag(Tag $tag, array $data): Tag
    {
        $tag->update($data);
        return $tag;
    }

    public function deleteTag(int $tagId): void
    {
        $category = $this->tagRespository->findTag($tagId);
        if (!$category) {
            throw new ModelNotFoundException('Tag not found');
        }
        $category->delete();
    }

}
