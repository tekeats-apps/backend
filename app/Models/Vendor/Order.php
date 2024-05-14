<?php

namespace App\Models\Vendor;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Enums\Vendor\Orders\OrderType;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Vendor\Orders\OrderStatus;
use App\Enums\Vendor\Orders\PaymentStatus;
use App\Enums\Vendor\Orders\OrderPaymentMethod;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'customer_id',
        'rider_id',
        'address_id',
        'status',
        'payment_method',
        'payment_status',
        'order_type',
        'coupon_code',
        'notes',
        'subtotal_price',
        'total_price',
        'delivered_at'
    ];

    protected $dates = [
        'delivered_at',
        'created_at'
    ];

    protected $appends = ['status_text', 'order_type_text', 'payment_method_text', 'payment_status_text', 'order_actions'];
    protected $guarded = ['id'];
    protected $casts = [
        'status' => OrderStatus::class,
        'order_type' => OrderType::class,
        'payment_method' => OrderPaymentMethod::class,
        'payment_status' => PaymentStatus::class,
        'created_at' => 'datetime:M d, Y H:i',
        'subtotal_price' => 'float',
        'total_price' => 'float'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function rider()
    {
        return $this->belongsTo(Rider::class);
    }

    public function transactions()
    {
        return $this->hasMany(OrderTransaction::class);
    }

    public function charges()
    {
        return $this->hasMany(OrderCharge::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->order_id = 'ORD-' . strtoupper(Str::random(10));
        });
    }

    public function getStatusTextAttribute()
    {
        return match ($this->status) {
            OrderStatus::PENDING => 'Pending',
            OrderStatus::ACCEPTED => 'Accepted',
            OrderStatus::READY => 'Order is Ready',
            OrderStatus::ASSIGNED_TO_DRIVER => 'Assigned to Driver',
            OrderStatus::RIDER_PICKED_UP => 'Rider Picked Up',
            OrderStatus::DELIVERED => 'Delivered',
            OrderStatus::CANCELLED => 'Cancelled',
            default => 'Unknown Status',
        };
    }

    public function getOrderTypeTextAttribute()
    {
        return match ($this->order_type) {
            OrderType::DINE_IN => 'Dine In',
            OrderType::TAKE_AWAY => 'Take Away',
            OrderType::DELIVERY => 'Delivery',
            default => 'Unknown Type',
        };
    }

    public function getPaymentMethodTextAttribute()
    {
        return match ($this->payment_method) {
            OrderPaymentMethod::CARD => 'Card',
            OrderPaymentMethod::CASH => 'Cash',
            default => 'Unknown Type',
        };
    }

    public function getPaymentStatusTextAttribute()
    {
        return match ($this->payment_status) {
            PaymentStatus::UNPAID => 'Unpaid',
            PaymentStatus::PAID => 'Paid',
            PaymentStatus::FAILED => 'Failed',
            default => 'Unknown Type',
        };
    }

    public function getOrderActionsAttribute(){
        return [
            OrderStatus::ACCEPTED->value => $this->status == OrderStatus::PENDING,
            OrderStatus::CANCELLED->value => in_array($this->status, [OrderStatus::PENDING, OrderStatus::ACCEPTED]),
            OrderStatus::READY->value => $this->status == OrderStatus::ACCEPTED,
            OrderStatus::ASSIGNED_TO_DRIVER->value => $this->status == OrderStatus::READY && $this->order_type == OrderType::DELIVERY,
            OrderStatus::DELIVERED->value => $this->status == OrderStatus::READY && $this->order_type != OrderType::DELIVERY,
            OrderStatus::RIDER_PICKED_UP->value => $this->status == OrderStatus::ASSIGNED_TO_DRIVER && $this->order_type == OrderType::DELIVERY,
        ];
    }

    public function canBeAccepted()
    {
        return $this->status == OrderStatus::PENDING;
    }

    public function canBeCancelled()
    {
        return in_array($this->status, [OrderStatus::PENDING, OrderStatus::ACCEPTED]);
    }

    public function canBeMarkedAsReady()
    {
        return $this->status == OrderStatus::ACCEPTED;
    }

    public function canBeAssignedToDriver()
    {
        return $this->status == OrderStatus::READY && $this->order_type == OrderType::DELIVERY;
    }

    public function canBeMarkedAsDelivered()
    {
        return $this->status == OrderStatus::READY && $this->order_type != OrderType::DELIVERY;
    }

    public function canBePickedUpByRider()
    {
        return $this->status == OrderStatus::ASSIGNED_TO_DRIVER && $this->order_type == OrderType::DELIVERY;
    }


    public function statusHistory()
    {
        return $this->hasMany(OrderStatusHistory::class);
    }

    public function scopeGetOrdersList($query, $search, $status, $paymentStatus, $startDate, $endDate, $sortField, $sortDirection)
    {
        $query = $query->with('customer');
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('customer_name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('invoice_no', 'like', '%' . $search . '%')
                    ->orWhere('payment_status', 'like', '%' . $search . '%');
            });
        }
        if (!empty($startDate)) {
            $startDate = Carbon::parse($startDate);
            $endDate = Carbon::parse($endDate ?? $startDate)->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        if (!empty($status)) {
            $query->where('status', $status);
        }
        if (!empty($paymentStatus)) {
            $query->where('payment_status', $paymentStatus);
        }

        return $query->orderBy($sortField, $sortDirection);
    }

    /**
     * Scope a query to get order by ID.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $orderId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGetOrderByOrderID($query, $orderId)
    {
        return $query->with(['customer', 'address', 'charges','rider', 'items.product:id,name,image', 'items.variant:id,name,price'])->where('order_id', $orderId)->first();
    }

    public function scopeGetCustomerOrders($query, $fields = ['*'], $sortField = 'id', $sortDirection = 'desc', $whereConditions = [], $relations = [])
    {
        foreach ($relations as $relation => $relationFields) {
            $query->with([$relation => function ($query) use ($relationFields) {
                $query->select($relationFields);
            }]);
        }

        $query->select($fields);
        foreach ($whereConditions as $column => $value) {
            $query->where($column, $value);
        }

        return $query->orderBy($sortField, $sortDirection);
    }
}
