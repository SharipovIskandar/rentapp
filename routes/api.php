<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);  // List all users
    Route::get('/{id}', [UserController::class, 'show']);  // Specific user
    Route::post('/', [UserController::class, 'store']);  // Create user
    Route::put('/{id}', [UserController::class, 'update']);  // Update user
    Route::delete('/{id}', [UserController::class, 'destroy']);  // Delete user

    Route::get('/gender/{gender}', [UserController::class, 'getByGender']);  // Users by gender
    Route::get('/position/{position}', [UserController::class, 'getByPosition']);  // Users by position
    Route::get('/branch/{branchId}', [UserController::class, 'getByBranch']);  // Users by branch

    Route::get('/{id}/ads', [UserController::class, 'getUserAds']);  // User's ads
    Route::get('/{id}/bookmarks', [UserController::class, 'getUserBookmarks']);  // User's bookmarks
    Route::get('/{id}/ads/active', [UserController::class, 'getUserActiveAds']);  // User's active ads
    Route::get('/{id}/ads/inactive', [UserController::class, 'getUserInactiveAds']);  // User's inactive ads
});

Route::prefix('ads')->group(function () {
    Route::get('/', [AdController::class, 'index']);  // List all ads
    Route::get('/{id}', [AdController::class, 'show']);  // Specific ad
    Route::post('/', [AdController::class, 'store']);  // Create ad
    Route::put('/{id}', [AdController::class, 'update']);  // Update ad
    Route::delete('/{id}', [AdController::class, 'destroy']);  // Delete ad

    Route::get('/branch/{branchId}', [AdController::class, 'getByBranch']);  // Ads by branch
    Route::get('/price/{min}/{max}', [AdController::class, 'getByPriceRange']);  // Ads by price range
    Route::get('/gender/{gender}', [AdController::class, 'getByGender']);  // Ads by gender

    Route::get('/active', [AdController::class, 'getActiveAds']);  // Active ads
    Route::get('/inactive', [AdController::class, 'getInactiveAds']);  // Inactive ads
});

Route::prefix('branches')->group(function () {
    Route::get('/', [BranchController::class, 'index']);  // List all branches
    Route::get('/{id}', [BranchController::class, 'show']);  // Specific branch
    Route::post('/', [BranchController::class, 'store']);  // Create branch
    Route::put('/{id}', [BranchController::class, 'update']);  // Update branch
    Route::delete('/{id}', [BranchController::class, 'destroy']);  // Delete branch

    Route::get('/{id}/ads', [BranchController::class, 'getBranchAds']);  // Ads by branch
    Route::get('/{id}/users', [BranchController::class, 'getBranchUsers']);  // Users by branch

    Route::get('/{id}/ads/count', [BranchController::class, 'countBranchAds']);  // Ads count in branch
    Route::get('/{id}/users/count', [BranchController::class, 'countBranchUsers']);  // Users count in branch
    Route::get('/{id}/ads/active', [BranchController::class, 'getBranchActiveAds']);  // Active ads in branch
    Route::get('/{id}/ads/inactive', [BranchController::class, 'getBranchInactiveAds']);  // Inactive ads in branch
});
