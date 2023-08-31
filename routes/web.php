<?php

use App\Http\Controllers\CapabilityController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\DashboardController;
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
    return redirect('/dashboard');
});

Route::middleware(['auth', 'verified'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware('auth')->controller(MemberController::class)->group(function() {
    Route::get('members', 'index')->name('members.index');
    Route::post('members', 'store')->name('members.store');
    Route::get('members/cancel', 'cancel')->name('members.cancel');
    Route::get('members/create/{user}', 'create')->name('members.create-for-user');
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
