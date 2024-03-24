<?php

namespace App\Http\Controllers\API\V1\Tags;

use Log;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Vendor\Tags\CreateTagRequest;
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
     * create tag
     *
     * 🗝️ Use this endpoint to log in and gain access to your account. You'll get a token you can use to do even more awesome things!
     *
     * @authenticated
     *
     */
    public function createTag(CreateTagRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $tag = $this->tagService->createTag($validatedData);
            return $this->successResponse($tag, "Tag has been successfully added.", Response::HTTP_OK);
        } catch (Exception $e) {
            return $this->exceptionResponse($e, 'An error occurred while saving the tag: ' . $e->getMessage());
        }
    }
}
