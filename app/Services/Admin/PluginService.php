<?php

namespace App\Services\Admin;

use App\Models\Plugin;
use App\Models\PluginType;
use App\Traits\TenantImageUploadTrait;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Plugin\PluginRepository;

class PluginService
{
    use TenantImageUploadTrait;

    protected $pluginRepository;
    protected $pluginType;

    public function __construct(PluginRepository $pluginRepository, PluginType $pluginType)
    {
        $this->pluginRepository = $pluginRepository;
        $this->pluginType = $pluginType;
    }

    public function getPlugins()
    {
        return $this->pluginRepository->getPlugins();
    }

    public function getPluginTypes()
    {
        return $this->pluginRepository->getPluginTypes();
    }

    public function getPluginType($id)
    {
        return $this->pluginRepository->getPluginType($id);
    }

    public function createPluginType($data)
    {
        return $this->pluginRepository->createPluginType($data);
    }

    public function updatePluginType($data, $id)
    {
        return $this->pluginRepository->updatePluginType($data, $id);
    }

    public function deletePluginType($id)
    {
        return $this->pluginRepository->deletePluginType($id);
    }

    public function getPluginTypesWithPlugins()
    {
        if (is_null($this->pluginType)) {
            return [];
        }
        return $this->pluginType->with('plugins')->get()->mapWithKeys(function ($type) {
            return [$type->name => $type->plugins];
        });
    }

    public function createPlugin($data)
    {

        $data['is_paid'] = isset($data['is_paid']) && $data['is_paid'] == 'true' ? 1 : 0;
        $data['active'] = isset($data['active']) && $data['active'] == 'false' ? 0 : 1;
        $data['featured'] = isset($data['featured']) && $data['featured'] == 'true' ? 1 : 0;
        $plugin = $this->pluginRepository->createPlugin($data);

        // Check if image is provided and save it
        if (!empty($data['image'])) {
            $image = $data['image'];
            $module = Plugin::IMAGE_PATH;
            $recordId = $plugin->id;
            $tableField = 'image';
            $tableName = 'plugins';

            $filename = $this->uploadImage($image, $module, $recordId, $tableField, $tableName);
            $plugin->image = $filename;
        }

        if (!empty($data['documentation'])) {
            $documentation = $data['documentation'];
            $module = Plugin::DOCUMENTATION_PATH;
            $recordId = $plugin->id;
            $tableField = 'documentation';
            $tableName = 'plugins';

            $filename = $this->uploadImage($documentation, $module, $recordId, $tableField, $tableName);
            $plugin->documentation = $filename;
        }

        return $plugin;
    }

    public function updatePlugin($data, Plugin $plugin)
    {

        if (isset($data['is_paid'])) {
            $data['is_paid'] = $data['is_paid'] == 'true' ? 1 : 0;
        }
        if (isset($data['active'])) {
            $data['active'] = $data['active'] == 'true' ? 1 : 0;
        }
        if (isset($data['featured'])) {
            $data['featured'] = $data['featured'] == 'true' ? 1 : 0;
        }

        $plugin->update($data);

        // Check if image is provided and save it
        if (!empty($data['image'])) {
            $image = $data['image'];
            $module = Plugin::IMAGE_PATH;
            $recordId = $plugin->id;
            $tableField = 'image';
            $tableName = 'plugins';

            if ($plugin->image) {
                $this->delete_image_by_name($module, $plugin->image);
            }

            $filename = $this->uploadImage($image, $module, $recordId, $tableField, $tableName);
            $plugin->image = $filename;
        }

        if (!empty($data['documentation'])) {
            $documentation = $data['documentation'];
            $module = Plugin::DOCUMENTATION_PATH;
            $recordId = $plugin->id;
            $tableField = 'documentation';
            $tableName = 'plugins';

            if ($plugin->documentation) {
                $this->delete_image_by_name($module, $plugin->documentation);
            }

            $filename = $this->uploadImage($documentation, $module, $recordId, $tableField, $tableName);
            $plugin->documentation = $filename;
        }

        return $plugin;
    }

    public function getPluginDetails($id)
    {
        return $this->pluginRepository->getPluginDetail($id);
    }

    public function deletePlugin($id)
    {
        $plugin = $this->pluginRepository->getPluginDetail($id);
        if ($plugin->image) {
            Storage::disk('s3')->delete(Plugin::IMAGE_PATH . '/' . $plugin->image);
        }
        if ($plugin->documentation) {
            Storage::disk('s3')->delete(Plugin::DOCUMENTATION_PATH . '/' . $plugin->documentation);
        }
        $plugin->delete();
        return $plugin;
    }
}
