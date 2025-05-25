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
        'status'
    ];

    public function customer() : BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function Items() : HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
