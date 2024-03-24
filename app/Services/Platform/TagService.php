<?php

namespace App\Services\Platform;

use App\Repositories\Platform\Tags\TagsRespository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Vendor\Tag;

class TagService
{
    protected TagsRespository $tagsRespository;

    public function __construct(TagsRespository $tagsRespository)
    {
        $this->tagsRespository = $tagsRespository;
    }
    public function getTagsList()
    {
        return $this->tagsRespository->tagsList();
    }
    public function getTagDetails($tagId)
    {
        return $this->tagsRespository->findTag($tagId);
    }
    public function createTag(array $data)
    {
        $category = $this->tagsRespository->createTag($data);
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
        $category = $this->tagsRespository->findTag($tagId);
        if (!$category) {
            throw new ModelNotFoundException('Tag not found');
        }
        $category->delete();
    }

}
