<?php

namespace App\Http\Livewire\Admin\Plugins;

use Livewire\Component;
use App\Models\PluginType as Type;

class PluginType extends Component
{
    public $search;
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    public function render()
    {
        return view('livewire.admin.plugins.plugin-type', ['pluginTypes' => $this->getPluginTypes()]);
    }

    protected function getPluginTypes()
    {
        return Type::getList($this->search, $this->sortField, $this->sortDirection)->paginate($this->perPage);
    }

    public function destroy($id)
    {
        try {
            Type::findOrFail($id)->delete();
            session()->flash('success', 'Plugin type deleted successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete plugin type: ' . $e->getMessage());
        }
    }
}
