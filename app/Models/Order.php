<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'order_date',
        'status',
        'total'
    ];

    /**
     * Get the customer that owns the order.
     */
    public function customer() : BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the user that owns the order.
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    /**
     * Get the order items for the order.
     */
    public function orderItems() : HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Legacy method for backward compatibility
     */
    public function Items() : HasMany
    {
        return $this->orderItems();
    }
}
