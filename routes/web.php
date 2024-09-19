<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\originatingController;
use App\Http\Controllers\serviceController;
use App\Http\Controllers\sidController;
use App\Http\Controllers\terminatingController;
use App\Http\Middleware\admin;
use Illuminate\Support\Facades\Route;

Route::get('/', [sidController::class, 'index']);
Route::post('/kirimsid',[sidController::class,'store']);


Route::middleware(admin::class)->group(function () {
    Route::get('/admin',[AdminController::class, 'index']);
    Route::get('/admin/originating',[originatingController::class, 'index']);
    Route::get('/admin/originating/create',[originatingController::class, 'create']);
    Route::get('/admin/originating/{id}/edit',[originatingController::class, 'edit']);
    Route::put('/originating/{id}/edit',[originatingController::class, 'update']);
    Route::delete('/originating/delete/{id}',[originatingController::class, 'destroy']);
    Route::post('/originating/create',[originatingController::class, 'store']);
    //terminating
    Route::get('/admin/terminating',[terminatingController::class, 'index']);
    Route::get('/admin/terminating/create',[terminatingController::class, 'create']);
    Route::get('/admin/terminating/{id}/edit',[terminatingController::class, 'edit']);
    Route::put('/terminating/{id}/edit',[terminatingController::class, 'update']);
    Route::delete('/terminating/delete/{id}',[terminatingController::class, 'destroy']);
    Route::post('/terminating/create',[terminatingController::class, 'store']);
    //service
    Route::get('/admin/service',[serviceController::class, 'index']);
    Route::get('/admin/service/create',[serviceController::class, 'create']);
    Route::get('/admin/service/{id}/edit',[serviceController::class, 'edit']);
    Route::put('/service/{id}/edit',[serviceController::class, 'update']);
    Route::delete('/service/delete/{id}',[serviceController::class, 'destroy']);
    Route::post('/service/create',[serviceController::class, 'store']);
    //sid
    Route::get('/admin/sid',[sidController::class, 'show']);
});

Route::get('/login',[AdminController::class, 'login']);
Route::post('/login',[AdminController::class, 'authenticate']);
Route::post('/logout',[AdminController::class, 'logout']);
