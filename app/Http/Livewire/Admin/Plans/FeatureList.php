<?php

namespace App\Http\Livewire\Admin\Plans;

use App\Models\PlanFeature;
use Livewire\Component;

class FeatureList extends Component
{
    public $search;
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    protected $listeners = ['delete-plan-feature' => 'destroy'];

    public function render()
    {
        return view('livewire.admin.plans.feature-list', ['planFeatures' => $this->getPlanFeatures()]);
    }

    protected function getPlanFeatures()
    {
        return PlanFeature::getList($this->search, $this->sortField, $this->sortDirection)->paginate($this->perPage);
    }

    public function confirmDelete($id)
    {
        // Show the SweetAlert confirmation dialog
        $this->emit('swal:confirm-delete', [
            'title' => 'Are you sure?',
            'text' => 'You are about to delete the plan feature. This action cannot be undone.',
            'planFeatureId' => $id,
        ]);
    }

    public function destroy($id)
    {
        try {
            PlanFeature::findOrFail($id)->delete();

            $this->emit('delete', ['message' => 'Plan feature deleted successfully!']);
        } catch (\Exception $e) {
            $this->emit('exception', ['message' => 'Failed to delete plan feature: ' . $e->getMessage()]);
        }
    }
}
