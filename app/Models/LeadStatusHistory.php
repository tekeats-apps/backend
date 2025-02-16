<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeadStatusHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'changed_by',
        'old_status',
        'new_status',
        'reason'
    ];

    /**
     * Get the lead that owns the status history
     */
    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    /**
     * Get the user that changed the lead status
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
