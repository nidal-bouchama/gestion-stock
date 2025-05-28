<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// ...existing routes...

Route::get('/products/{id}/image', [App\Http\Controllers\Api\ProductImageController::class, 'getImage']);