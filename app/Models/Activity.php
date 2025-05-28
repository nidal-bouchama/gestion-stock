<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'type',
        'action',
        'user_id',
        'subject_id',
        'subject_type',
        'icon'
    ];

    /**
     * Get the user that performed the activity.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the subject of the activity.
     */
    public function subject()
    {
        return $this->morphTo();
    }

    /**
     * Get the appropriate icon based on activity type.
     */
    public function getIconAttribute($value)
    {
        if ($value !== 'fas fa-circle') {
            return $value;
        }

        // Default icons based on type
        $icons = [
            'product' => 'fas fa-box',
            'category' => 'fas fa-tags',
            'order' => 'fas fa-shopping-cart',
            'customer' => 'fas fa-user',
            'supplier' => 'fas fa-truck',
            'stock-arrival' => 'fas fa-dolly'
        ];

        return $icons[$this->type] ?? 'fas fa-circle';
    }
}
