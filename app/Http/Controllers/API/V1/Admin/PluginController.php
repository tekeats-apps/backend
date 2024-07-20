<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Models\Plugin;
use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Admin\PluginService;
use App\Http\Requests\Admin\PluginTypeRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Admin\Plugin\GetPluginsRequest;
use App\Http\Requests\Admin\Plugin\CreatePluginRequest;
use App\Http\Requests\Admin\Plugin\UpadatePluginRequest;
use App\Http\Requests\Admin\Plugin\Types\GetPluginTypesRequest;
use App\Http\Requests\Platform\Plugins\UpdateSettingFieldsRequest;

class PluginController extends Controller
{
    use ApiResponse;
    protected $pluginService;

    public function __construct(PluginService $pluginService)
    {
        $this->pluginService = $pluginService;
    }

    //Plugin Types functions
    public function getPluginTypes(GetPluginTypesRequest $request){
        try{
            $limit = $request->limit ?? 10;
            $plugins = $this->pluginService->getPluginTypes()->paginate($limit);
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

    //Plugin functions
    public function getPlugins(GetPluginsRequest $request){
        try{
            $limit = $request->limit ?? 10;
            $plugins = $this->pluginService->getPlugins()->paginate($limit);
            return $this->successResponse($plugins, "Plugins fetched successfully!");
        }catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getActivePlugins()
    {
        try {
            $plugins = $this->pluginService->getActivePlugins()->get();
            return $this->successResponse($plugins, "Active plugins fetched successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function createPlugin(CreatePluginRequest $request)
    {
        try {
            $plugins = $this->pluginService->createPlugin($request->validated());
            return $this->successResponse($plugins, "Plugin created successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updatePlugin(UpadatePluginRequest $request, Plugin $plugin)
    {
        try {
            $plugins = $this->pluginService->updatePlugin($request->validated(), $plugin);
            return $this->successResponse($plugins, "Plugin updated successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getPluginDetails($id)
    {
        try {
            $plugin = $this->pluginService->getPluginDetails($id);
            return $this->successResponse($plugin, "Plugin details fetched successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function deletePlugin($id)
    {
        try {
            $this->pluginService->deletePlugin($id);
            return $this->successResponse([], "Plugin deleted successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updatePluginSettingsForm(UpdateSettingFieldsRequest $request, Plugin $plugin)
    {
        try {
            $this->pluginService->updatePluginSettingsForm($request->all(), $plugin);
            return $this->successResponse($plugin->refresh(), "Plugin settings form updated successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getPluginSettingsForm($id)
    {
        try {
            $plugin = $this->pluginService->getPluginDetails($id);
            $settingsForm = $plugin->settings_form;
            return $this->successResponse($settingsForm, "Plugin settings form fetched successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
