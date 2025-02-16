<?php

namespace App\Enums;

enum LeadStatus: string
{
    case PENDING = 'pending';
    case IN_REVIEW = 'in_review';
    case CONTACTED = 'contacted';
    case REJECTED = 'rejected';
    case CONVERTED = 'converted';
    case CLOSED = 'closed';

     /**
     * Get allowed next statuses for current status
     * @return array<LeadStatus>
     */
    public function getAllowedTransitions(): array
    {
        return match($this) {
            self::PENDING => [
                self::IN_REVIEW,
                self::REJECTED
            ],
            self::IN_REVIEW => [
                self::CONTACTED,
                self::REJECTED
            ],
            self::CONTACTED => [
                self::CONVERTED,
                self::REJECTED,
                self::CLOSED
            ],
            self::REJECTED => [],  // Final state
            self::CONVERTED => [
                self::CLOSED
            ],
            self::CLOSED => []     // Final state
        };
    }

     /**
     * Check if a transition to target status is allowed
     */
    public function canTransitionTo(LeadStatus $targetStatus): bool
    {
        return in_array($targetStatus, $this->getAllowedTransitions());
    }

     /**
     * Get human readable label
     */
    public function getLabel(): string
    {
        return match($this) {
            self::PENDING => 'Pending',
            self::IN_REVIEW => 'In Review',
            self::CONTACTED => 'Contacted',
            self::REJECTED => 'Rejected',
            self::CONVERTED => 'Converted',
            self::CLOSED => 'Closed',
        };
    }
}
