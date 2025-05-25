<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'quantity',
        'image',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function stockArrivals()
    {
        return $this->hasMany(StockArrival::class);
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            $imageData = stream_get_contents($this->image);
            return 'data:image/jpeg;base64,' . base64_encode($imageData);
        }
        if ($this->image && Storage::disk('public')->exists('products/' . $this->image)) {
            return asset('storage/products/' . $this->image);
        }
        return asset('Images/default-product.png');
    }
}
