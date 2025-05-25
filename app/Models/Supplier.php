<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'contact_info',
        'phone'
    ];

    public function stockArrivals()
    {
        return $this->hasMany(StockArrival::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_supplier')
            ->withPivot('price', 'lead_time')
            ->withTimestamps();
    }
}
