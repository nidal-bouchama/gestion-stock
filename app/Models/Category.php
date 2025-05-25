<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    // Ensure the primary key is correctly set (default is 'id')
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
