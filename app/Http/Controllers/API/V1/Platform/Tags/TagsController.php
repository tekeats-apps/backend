<?php

namespace App\Http\Controllers\API\V1\Platform\Tags;

use Log;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Platform\Tags\CreateTags;
use App\Http\Requests\Platform\Tags\TagsList;
use App\Http\Requests\Platform\Tags\UpdateTag;
use App\Services\Platform\TagService;
use App\Models\Vendor\Tag;
/**
 * @tags Platform
 */
class TagsController extends Controller
{
    use ApiResponse;
    protected TagService $tagService;
    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    /**
     * Get Tags List
     *
     * @authenticated
     *
     * Fetch all the categories added by platform user.
     */
    public function getTags(TagsList $request): \Illuminate\Http\JsonResponse
    {
        try {
            $limit = $request->input('limit', 10);

            $categories = $this->tagService->getTagsList()->paginate($limit);

            return $this->successResponse($categories, "Categories listed successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    /**
     * Create A Tag
     *
     * @authenticated
     *
     * Creates a new tags with the provided data.
     */
    public function createTag(CreateTags $request): \Illuminate\Http\JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $tag = $this->tagService->createTag($validatedData);
            return $this->successResponse($tag, "Tag has been successfully added.", Response::HTTP_OK);
        } catch (Exception $e) {
            return $this->exceptionResponse($e, 'An error occurred while saving the tag: ' . $e->getMessage());
        }
    }

    /**
     * Get Tag Details
     *
     * @authenticated
     *
     * Fetch details of a specific tag.
     *
     * @param int $tag The ID of the tag to fetch details for.
     */
    public function getTagDetails(int $tag): \Illuminate\Http\JsonResponse
    {
        try {
            $tagDetails = $this->tagService->getTagDetails($tag);

            if (!$tagDetails) {
                return $this->errorResponse('Tag not found', Response::HTTP_NOT_FOUND);
            }

            return $this->successResponse($tagDetails, "Tag details retrieved successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update Tag
     *
     * @authenticated
     *
     * Updates the specified tag with the provided data.
     *
     * @param UpdateTags $request
     * @param Tag $tag The ID of the tag to update.
     * @return JsonResponse
     */
    public function updateTag(UpdateTag $request, Tag $tag): \Illuminate\Http\JsonResponse
    {
        try {
            $data = $request->validated();
            $updatedTag = $this->tagService->updateTag($tag, $data);
            return $this->successResponse($updatedTag, "Tag updated successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Delete a Tag
     *
     * @authenticated
     *
     * Deletes the specified Tag.
     *
     * @param int $tag The ID of the tag to delete.
     * @return JsonResponse
     */
    public function deleteTag(int $tag): \Illuminate\Http\JsonResponse
    {
        try {
            $this->tagService->deleteTag($tag);
            return $this->successResponse(null, "Tag deleted successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
