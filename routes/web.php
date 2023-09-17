<?php

use App\Http\Controllers\members\CapabilityController;
use App\Http\Controllers\members\CertificationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\members\MemberController;
use App\Http\Controllers\members\OtherController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\resources\CategoryController;
use App\Http\Controllers\resources\FileController;
use App\Http\Controllers\resources\ResourceController;
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

require __DIR__.'/auth.php';

Route::middleware('auth')->controller(CapabilityController::class)->group(function () {
    Route::get('capabilities', 'list')->name('capabilities.list');
    Route::put('capabilities/save', 'save')->name('capabilities.save');
});

Route::middleware('auth')->controller(CategoryController::class)->group(function () {
    Route::get('categories/{access}', 'list')->name('categories.list');
    Route::put('categories/save', 'save')->name('categories.save');
});

Route::middleware('auth')->controller(CertificationController::class)->group(function () {
    Route::get('certifications', 'list')->name('certifications.list');
    Route::put('certifications/save', 'save')->name('certifications.save');
});

Route::middleware('auth')->resource('files', FileController::class);

Route::middleware('auth')->controller(OtherController::class)->group(function () {
    Route::get('others', 'list')->name('others.list');
    Route::put('others/save', 'save')->name('others.save');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->controller(MemberController::class)->group(function () {
    Route::get('members/cancel', 'cancel')->name('members.cancel');
    Route::get('members/create/{user}', 'create')->name('members.create-for-user');
});
Route::middleware('auth')->resource('members', MemberController::class);

Route::middleware('auth')->controller(ResourceController::class)->group(function () {
    Route::get('resource/{name}', 'view')->name('resource.view');
    Route::get('resource/{name}/download', 'download')->name('resource.download');
});

Route::middleware('auth')->controller(UserController::class)->group(function () {
    Route::get('users/cancel', 'cancel')->name('users.cancel');
});
Route::middleware('auth')->resource('users', UserController::class);
