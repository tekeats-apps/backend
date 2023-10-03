<?php

namespace App\Http\Livewire\Admin\Plugins;

use App\Models\Plugin;
use Livewire\Component;

class PluginList extends Component
{
    public $search;
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    public function render()
    {
        return view('livewire.admin.plugins.plugin-list', ['plugins' => $this->getPlugins()]);
    }

    protected function getPlugins()
    {
        return Plugin::getList($this->search, $this->sortField, $this->sortDirection)->paginate($this->perPage);
    }

    public function destroy($uuid)
    {
        try {
            Plugin::findOrFail($uuid)->delete();
            session()->flash('success', 'Plugin deleted successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete plugin: ' . $e->getMessage());
        }
    }
}
