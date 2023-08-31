<?php

use App\Http\Controllers\CapabilityController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OtherController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Route::prefix('/admin')->middleware('auth')->controller(CapabilityController::class)->group(function() {
//     Route::get('capabilities', 'index')->name('capabilities.index');
//     Route::post('capabilities', 'store')->name('capabilities.store');
//     Route::get('capabilities/cancel', 'cancel')->name('capabilities.cancel');
//     Route::get('capabilities/create', 'create')->name('capabilities.create');
//     Route::get('capabilities/{capability}', 'show')->name('capabilities.show');
//     Route::put('capabilities/{capability}', 'update')->name('capabilities.update');
//     Route::delete('capabilities/{capability}', 'destroy')->name('capabilities.destroy');
//     Route::get('capabilities/{capability}/edit', 'edit')->name('capabilities.edit');
// });
// Route::prefix('/admin')->middleware('auth')->controller(CertificationController::class)->group(function() {
//     Route::get('certifications', 'index')->name('certifications.index');
//     Route::post('certifications', 'store')->name('certifications.store');
//     Route::get('certifications/cancel', 'cancel')->name('certifications.cancel');
//     Route::get('certifications/create', 'create')->name('certifications.create');
//     Route::get('certifications/{certification}', 'show')->name('certifications.show');
//     Route::put('certifications/{certification}', 'update')->name('certifications.update');
//     Route::delete('certifications/{certification}', 'destroy')->name('certifications.destroy');
//     Route::get('certifications/{certification}/edit', 'edit')->name('certifications.edit');
// });
Route::middleware('auth')->controller(MemberController::class)->group(function() {
    Route::get('members', 'index')->name('members.index');
    Route::post('members', 'store')->name('members.store');
    Route::get('members/cancel', 'cancel')->name('members.cancel');
    Route::get('members/create', 'create')->name('members.create');
    Route::get('members/{member}', 'show')->name('members.show');
    Route::put('members/{member}', 'update')->name('members.update');
    Route::delete('members/{member}', 'destroy')->name('members.destroy');
    Route::get('members/{member}/edit', 'edit')->name('members.edit');
    Route::get('members/cancel', 'cancel')->name('members.cancel');
});

Route::middleware('auth')->resource('capabilities', CapabilityController::class);
Route::middleware('auth')->resource('certifications', CertificationController::class);
Route::middleware('auth')->resource('others', OtherController::Class);

Route::middleware('auth')->controller(UserController::class)->group(function () {
    Route::get('users', 'index')->name('users.index');
    Route::post('users', 'store')->name('users.store');
    Route::get('users/cancel', 'cancel')->name('users.cancel');
    Route::get('users/create', 'create')->name('users.create');
    Route::get('users/{user}', 'show')->name('users.show');
    Route::put('users/{user}', 'update')->name('users.update');
    Route::delete('users/{user}', 'destroy')->name('users.destroy');
    Route::get('users/{user}/edit', 'edit')->name('users.edit');
    Route::get('users/cancel', 'cancel')->name('users.cancel');
});
