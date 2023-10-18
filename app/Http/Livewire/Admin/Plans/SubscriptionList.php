<?php

namespace App\Http\Livewire\Admin\Plans;

use App\Models\PlanSubscription;
use Livewire\Component;

class SubscriptionList extends Component
{
    public $search;
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    protected $listeners = ['delete' => 'destroy'];

    public function render()
    {
        return view('livewire.admin.plans.subscription-list', ['planSubscriptions' => $this->getPlanSubscriptions()]);
    }

    protected function getPlanSubscriptions()
    {
        return PlanSubscription::getList($this->search, $this->sortField, $this->sortDirection)->paginate($this->perPage);
    }

    public function confirmDelete($id)
    {
        // Show the SweetAlert confirmation dialog
        $this->emit('swal:confirm-delete', [
            'title' => 'Are you sure?',
            'text' => 'You are about to delete the plan subscription. This action cannot be undone.',
            'id' => $id,
        ]);
    }

    public function destroy($uuid)
    {
        try {
            PlanSubscription::findOrFail($uuid)->delete();
            $this->dispatchBrowserEvent('success', ['message' => 'Plan subscription deleted successfully!']);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('error', ['message' => 'Failed to delete plan subscription: ' . $e->getMessage()]);
        }
    }
}
