<?php

namespace App\Services\Admin;

use App\Models\Lead;
use App\Enums\LeadStatus;
use App\Events\LeadCreated;
use App\Repositories\Lead\LeadRepository;

class LeadService
{
    public function __construct(protected LeadRepository $leadRepository) {}

    public function createLead(array $data): Lead
    {
        // Ensure system_goals is an array
        if (isset($data['system_goals']) && is_string($data['system_goals'])) {
            $data['system_goals'] = explode(',', $data['system_goals']);
        }

        $lead = $this->leadRepository->create($data);

            // Dispatch the event
        event(new LeadCreated($lead));

        return $lead;

    }

    public function updateLeadStatus(Lead $lead, $status, $reason = null): bool
    {
        return $this->leadRepository->update(['status' => $status, 'reason' => $reason], $lead->id);
    }

    public function getLeadsByStatus(?LeadStatus $status = null)
    {
        return $this->leadRepository->getAllByLeads($status);
    }

    public function getLeadDetails($id):?Lead
    {
        return $this->leadRepository->find($id);
    }
}
