<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Vendor\Orders\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderStatusHistory extends Model
{
    use HasFactory;

    protected $table = 'order_status_history';

    protected $fillable = [
        'order_id',
        'status',
    ];

    protected $appends = [
        'status_text'
    ];

    protected $casts = [
        'status' => OrderStatus::class,
        'created_at' => 'datetime:M d, Y H:i',
    ];

    public function getStatusTextAttribute()
    {
        return match ($this->status) {
            OrderStatus::PENDING => 'Pending',
            OrderStatus::ACCEPTED => 'Accepted',
            OrderStatus::READY => 'Order Ready',
            OrderStatus::ASSIGNED_TO_DRIVER => 'Assigned to Driver',
            OrderStatus::RIDER_PICKED_UP => 'Rider Picked Up',
            OrderStatus::DELIVERED => 'Delivered',
            OrderStatus::RETURNED => 'Returned',
            OrderStatus::CANCELLED => 'Cancelled',
            default => 'Unknown Status',
        };
    }

    // Scope function to get the history of a specific order
    public function scopeOfOrder($query, $orderId)
    {
        return $query->where('order_id', $orderId);
    }
}
