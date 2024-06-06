<?php

namespace App\Models\Vendor;

use Illuminate\Notifications\DatabaseNotification;

class Notification extends DatabaseNotification
{
    protected $appends = ['formatted'];

    // Accessor for formatted notification
    public function getFormattedAttribute()
    {
        return [
            'id' => $this->id,
            'data' => $this->data,
            'read' => $this->read_at !== null,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}