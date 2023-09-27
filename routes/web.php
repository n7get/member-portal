<?php

use App\Http\Controllers\activities\ActivityController;
use App\Http\Controllers\activities\ActivityModeController;
use App\Http\Controllers\activities\ActivityTypeController;
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

Route::middleware('auth')->controller(ActivityController::class)->group(function () {
    Route::put('activities/save/{activity}', 'save')->name('activities.save');
    Route::get('activities/attending/{activity}', 'attending')->name('activities.attending');
    Route::get('activities/logs/{activity}', 'logs')->name('activities.logs');
    Route::post('activities/update/attending/{activity}', 'updateAttending')->name('activities.update.attending');
    Route::put('activities/update/logs/{activity}', 'updateLogs')->name('activities.update.logs');
});
Route::middleware('auth')->resource('activities', ActivityController::class);
Route::middleware('auth')->controller(ActivityModeController::class)->group(function () {
    Route::get('activity_modes', 'list')->name('activity_modes.list');
    Route::put('activity_modes/save', 'save')->name('activity_modes.save');
});
Route::middleware('auth')->controller(ActivityTypeController::class)->group(function () {
    Route::get('activity_types', 'list')->name('activity_types.list');
    Route::put('activity_types/save', 'save')->name('activity_types.save');
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
