<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'address',
        'phone',
        'profile_image',
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Check if the user is an admin
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === 'admin' || $this->role === 'super_admin';
    }

    /**
     * Check if the user is a super admin
     *
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->role === 'super_admin';
    }

    /**
     * Get the orders for the user
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }

    /**
     * Get the profile image URL
     */
    public function getProfileImageUrlAttribute()
    {
        if ($this->profile_image) {
            return asset('storage/profiles/' . $this->profile_image);
        }
        return asset('Images/default-profile.png');
    }
}
