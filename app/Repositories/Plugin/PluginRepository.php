<?php

namespace App\Repositories\Plugin;

use App\Models\Plugin;
use App\Models\PluginType;
use App\Repositories\Plugin\PluginRepositoryInterface;

class PluginRepository implements PluginRepositoryInterface
{
    protected $pluginType;
    protected $plugin;

    public function __construct(PluginType $pluginType, Plugin $plugin)
    {
        $this->pluginType = $pluginType;
        $this->plugin = $plugin;
    }

    public function getPluginTypes()
    {
        return $this->pluginType->all();
    }

    public function getPluginType($id)
    {
        return $this->pluginType->find($id);
    }

    public function createPluginType($data)
    {
        return $this->pluginType->create($data);
    }

    public function updatePluginType($data, $id)
    {
        $pluginType = $this->pluginType->find($id);
        $pluginType->update($data);
        return $pluginType;
    }

    public function deletePluginType($id)
    {
        return $this->pluginType->find($id)->delete();
    }
}
