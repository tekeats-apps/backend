<?php

namespace App\Http\Controllers\API\V1\Platform;

use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Admin\PluginService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Platform\Plugins\UpdatePluginRequest;

class PluginController extends Controller
{
    use ApiResponse;
    protected $pluginService;

    public function __construct(PluginService $pluginService)
    {
        $this->pluginService = $pluginService;
    }

    public function getPlugins()
    {
        try {
            $plugins = $this->pluginService->getPluginTypesWithPlugins();
            return $this->successResponse($plugins, "Plugins fetched successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updatePlugin(UpdatePluginRequest $request, $plugin_id)
    {
        try {
            $this->pluginService->updatePlatformPlugin($plugin_id, $request->validated());
            return $this->successResponse([], "Plugin updated successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
