<?php

use App\Modules\Campaign\Http\Controllers\CampaignController;
use App\Modules\Customer\Http\Controllers\CustomerController;
use App\Modules\Segment\Http\Controllers\SegmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('customers', CustomerController::class);
Route::apiResource('segments', SegmentController::class);
Route::post('segments/{id}/customers/{customerId}', [SegmentController::class, 'attachCustomer']);
Route::delete('segments/{id}/customers/{customerId}', [SegmentController::class, 'detachCustomer']);
Route::post('campaigns', [CampaignController::class, 'store']);
Route::post('campaigns/{id}/dispatch', [CampaignController::class, 'dispatch']);
