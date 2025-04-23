<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('product', ProductController::class);
Route::apiResource('banner', BannerController::class);
Route::apiResource('brand', BrandController::class);
Route::apiResource('category', CategoryController::class);
Route::apiResource('contact', ContactController::class);
Route::apiResource('menu', MenuController::class);
Route::apiResource('order', OrderController::class);
Route::apiResource('post', PostController::class);
Route::apiResource('topic', TopicController::class);
Route::apiResource('user', UserController::class);
