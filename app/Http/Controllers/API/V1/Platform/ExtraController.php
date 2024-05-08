<?php

namespace App\Http\Controllers\API\V1\Platform;

use App\Traits\ApiResponse;
use App\Models\Vendor\Extra;
use App\Http\Controllers\Controller;
use App\Services\Platform\ExtraService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Platform\Extra\ListExtras;
use App\Http\Requests\Platform\Extra\CreateExtra;
use App\Http\Requests\Platform\Extra\UpdateExtra;


class ExtraController extends Controller
{
    use ApiResponse;

    protected ExtraService $extraService;

    public function __construct(ExtraService $extraService)
    {
        $this->extraService = $extraService;
    }

    /**
     * Get Extras
     *
     * @authenticated
     *
     * Fetch all the extras lisitng with data and stats.
     */
    public function getExtras(ListExtras $request): \Illuminate\Http\JsonResponse
    {
        try {
            $limit = $request->input('limit', 10);

            $extras = $this->extraService->getExtras()->paginate($limit);

            return $this->successResponse($extras, "Extras fetched successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Create Extra
     *
     * @authenticated
     *
     * Create a new extra with the provided name.
     *
     * @param string $name The name of the extra.
     * @return \Illuminate\Http\JsonResponse
     */
    public function createExtra(CreateExtra $request): \Illuminate\Http\JsonResponse
    {
        try {
            $data = $request->validated();
            $extra = $this->extraService->createExtra($data);

            return $this->successResponse($extra, "Extra created successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update Extra
     *
     * @authenticated
     *
     * Updates the specified extra with the provided data.
     *
     * @param UpdateExtra $request
     * @param Extra $extra The ID of the extra to update.
     * @return JsonResponse
     */
    public function updateExtra(UpdateExtra $request, Extra $extra): \Illuminate\Http\JsonResponse
    {
        try {
            $data = $request->validated();
            $updatedExtra = $this->extraService->updateExtra($extra, $data);
            return $this->successResponse($updatedExtra, "Extra updated successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get Extra Details
     *
     * @authenticated
     *
     * Fetch details of a specific extra.
     *
     * @param int $extra The ID of the extra to fetch details for.
     */
    public function getExtraDetails(int $extra): \Illuminate\Http\JsonResponse
    {
        try {
            $extraDetails = $this->extraService->getExtraDetails($extra);
            if (!$extraDetails) {
                return $this->errorResponse('Extra not found', Response::HTTP_NOT_FOUND);
            }

            return $this->successResponse($extraDetails, "Extra details retrieved successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Delete a Extra (Soft Delete)
     *
     * @authenticated
     *
     * Deletes the specified extra.
     *
     * @param int $extra The ID of the extra to delete.
     * @return JsonResponse
     */
    public function deleteExtra(int $extra): \Illuminate\Http\JsonResponse
    {
        try {
            $extra = $this->extraService->getExtraDetails($extra);
            if (!$extra) {
                return $this->errorResponse('Extra not found', Response::HTTP_NOT_FOUND);
            }
            $extra->delete();
            return $this->successResponse(null, "Extra deleted successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
