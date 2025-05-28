<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

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
    /**
     * Get the category that owns the product.
     */
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
        // If the image field already contains 'products/', use as is
        $imagePath = str_starts_with($this->image, 'products/')
            ? $this->image
            : 'products/' . $this->image;

        if (\Storage::disk('public')->exists($imagePath)) {
            return asset('storage/' . $imagePath);
        }
    }
    return asset('Images/default-product.png');
    }
}
