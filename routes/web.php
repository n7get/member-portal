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
use App\Http\Controllers\resources\ResourceFilesController;
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

Route::middleware('auth')->resource('capabilities', CapabilityController::class);
Route::middleware('auth')->resource('categories', CategoryController::class);
Route::middleware('auth')->controller(ResourceFilesController::class)->group(function () {
    Route::get('categories/{category}/files/create', 'create')->name('categories.files.create');
    Route::post('categories/{category}/files', 'store')->name('categories.files.store');
    Route::get('categories/{category}/files/{file}/edit', 'edit')->name('categories.files.edit');
    Route::put('categories/{category}/files/{file}', 'update')->name('categories.files.update');
    Route::delete('categories/{category}/files/{file}', 'destroy')->name('categories.files.destroy');
});
Route::middleware('auth')->resource('certifications', CertificationController::class);
Route::middleware('auth')->resource('files', FileController::class);
Route::middleware('auth')->resource('others', OtherController::class);

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
