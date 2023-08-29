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

Route::prefix('/admin')->middleware('auth')->resource('capabilities', CapabilityController::class);
Route::prefix('/admin')->middleware('auth')->resource('certifications', CertificationController::class);
Route::prefix('/admin')->middleware('auth')->resource('members', MemberController::class);
Route::prefix('/admin')->middleware('auth')->resource('others', OtherController::Class);

Route::middleware('auth')->resource('users', UserController::class);
