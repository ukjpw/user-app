<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::controller(UserController::class)->group(function() {

Route::get('/', 'list')->name('users.list');
Route::get('/users', 'list')->name('users.indexlist');
Route::get('/users/create', 'create')->name('users.create');

// Edit existing product
Route::get('/users/edit/{id}', 'edit')->name('users.edit');

// View existing product
//Route::get('/users/{id}', 'show')->name('users.show');

// Delete existing product
Route::delete('/users/delete/{id}', 'destroy')->name('users.destroy');

});