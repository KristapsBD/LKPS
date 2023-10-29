<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::middleware("admin")->group( function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'viewAllUsers'])->name('admin.users');

    Route::get('/admin/edit-user/{user}', [AdminController::class, 'editUserForm'])->name('admin.editUserForm');
    Route::put('/admin/edit-user/{user}', [AdminController::class, 'editUser'])->name('admin.editUser');

    Route::delete('/admin/delete-user/{user}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');

    Route::get('/admin/create-user', [AdminController::class, 'createUserForm'])->name('admin.createUserForm');
    Route::post('/admin/create-user', [AdminController::class, 'createUser'])->name('admin.createUser');

});

require __DIR__.'/auth.php';
