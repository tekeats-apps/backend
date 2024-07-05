<?php

namespace App\Services\Platform;

use App\Models\Plugin;
use App\Models\PluginType;

class PluginService
{
    protected $plugin;
    protected $pluginType;

    public function __construct(Plugin $plugin, PluginType $pluginType)
    {
        $this->plugin = $plugin;
    }

    public function getPlugins()
    {
        return $this->plugin->all();
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

