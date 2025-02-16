<?php

namespace App\Repositories\Platform;

use App\Models\Vendor\PlatformPlugin;

class PlatformPluginRepository
{
    protected $platformPlugins;

    public function __construct(PlatformPlugin $platformPlugins)
    {
        $this->platformPlugins = $platformPlugins;
    }

    public function getPluginByUUID($plugin_id)
    {
        return $this->platformPlugins->where('plugin_id', $plugin_id)->first();
    }

    public function getPluginStatus($pluginId)
    {
        return $this->platformPlugins->where('plugin_id', $pluginId)->first();
    }

    public function updatePlugin($pluginId, $data)
    {
        return $this->platformPlugins->updateOrCreate(
            ['plugin_id' => $pluginId],
            $data
        );
    }

}
