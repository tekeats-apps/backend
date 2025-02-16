<?php

namespace App\Repositories\Plugin;

interface PluginRepositoryInterface
{
    public function getPluginTypes();
    public function createPluginType($data);
    public function updatePluginType($data, $id);
    public function deletePluginType($id);
}
