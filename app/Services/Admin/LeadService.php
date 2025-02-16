<?php

namespace App\Services\Admin;

use App\Models\Lead;
use App\Enums\LeadStatus;
use App\Events\LeadCreated;
use InvalidArgumentException;
use App\Models\LeadStatusHistory;
use Illuminate\Support\Facades\DB;
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

        LeadStatusHistory::create([
            'lead_id' => $lead->id,
            'new_status' => LeadStatus::PENDING
        ]);

        // Dispatch the event to send email to customer
        event(new LeadCreated($lead));

        return $lead;

    }

    public function updateLeadStatus(Lead $lead, LeadStatus $status, $reason = null): bool
    {
        if (!$lead->canTransitionTo($status)) {
            throw new InvalidArgumentException(
                "Cannot transition from {$lead->status->getLabel()} to {$status->getLabel()}"
            );
        }

        return DB::transaction(function () use ($lead, $status, $reason) {
            LeadStatusHistory::create([
                'lead_id' => $lead->id,
                'changed_by' => request()->user()->id,
                'old_status' => $lead->status,
                'new_status' => $status,
                'reason' => $reason
            ]);

            // Update lead status
            return $this->leadRepository->update([
                'status' => $status
            ], $lead->id);
        });
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
