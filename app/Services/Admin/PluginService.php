<?php

namespace App\Services\Admin;

use App\Models\Plugin;
use App\Models\PluginType;
use App\Repositories\Plugin\PluginRepository;

class PluginService
{
    protected $pluginRepository;
    protected $plugin;
    protected $pluginType;

    public function __construct(PluginRepository $pluginRepository, Plugin $plugin, PluginType $pluginType)
    {
        $this->pluginRepository = $pluginRepository;
        $this->plugin = $plugin;
        $this->pluginType = $pluginType;
    }

    public function getPlugins()
    {
        return $this->plugin->all();
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
        return $this->pluginType->with('plugins')->get()->groupBy('type')->map(function ($type) {
            return $type->pluck('plugins');
        });
    }
}
