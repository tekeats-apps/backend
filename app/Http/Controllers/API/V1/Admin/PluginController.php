<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Admin\PluginService;
use App\Http\Requests\Admin\PluginTypeRequest;
use Symfony\Component\HttpFoundation\Response;

class PluginController extends Controller
{
    use ApiResponse;
    protected $pluginService;

    public function __construct(PluginService $pluginService)
    {
        $this->pluginService = $pluginService;
    }

    public function getPluginTypes(){
        try{
            $plugins = $this->pluginService->getPluginTypes();
            return $this->successResponse($plugins, "Plugin types fetched successfully!");
        }catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function createPluginType(PluginTypeRequest $request)
    {
        try {
            $plugins = $this->pluginService->createPluginType($request->all());
            return $this->successResponse($plugins, "Plugin type created successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getPluginType($id)
    {
        try {
            $plugins = $this->pluginService->getPluginType($id);
            return $this->successResponse($plugins, "Plugin type fetched successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updatePluginType(PluginTypeRequest $request, $id)
    {
        try {
            $plugins = $this->pluginService->updatePluginType($request->all(), $id);
            return $this->successResponse($plugins, "Plugin type updated successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function deletePluginType($id)
    {
        try {
            $this->pluginService->deletePluginType($id);
            return $this->successResponse([], "Plugin type deleted successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
