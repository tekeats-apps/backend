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
}
