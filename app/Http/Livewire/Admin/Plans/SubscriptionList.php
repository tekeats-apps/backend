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

    public function render()
    {
        return view('livewire.admin.plans.subscription-list', ['planSubscriptions' => $this->getPlanSubscriptions()]);
    }

    protected function getPlanSubscriptions()
    {
        return PlanSubscription::getList($this->search, $this->sortField, $this->sortDirection)->paginate($this->perPage);
    }
}
