<?php

use App\Http\Controllers\AuthManager;
use App\Http\Controllers\TaskManager;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('auth');


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/users/create', [AdminController::class, 'create'])->name('users.create');
    Route::post('/users', [AdminController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [AdminController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [AdminController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('users.destroy');
});

Route::get("gotoreg", [AuthManager::class, "gotoreg"])
->name("gotoreg");
Route::get("gotologin", [AuthManager::class, "gotologin"])
->name("gotologin");

Route::get("login", [AuthManager::class, "login"])
->name("login");
Route::post("login", [AuthManager::class, "loginPost"])
->name("login.post");

Route::get("logout", [AuthManager::class, "logout"])
->name("logout");

Route::get("register", [AuthManager::class, "register"])
->name("register");
Route::post("register", [AuthManager::class, "registerPost"])
->name("register.post");

Route::middleware("auth")->group( function () {
    Route::get('/', [TaskManager::class, "listTask"])
    ->name("home");

    Route::get("task/add", [TaskManager::class, "addTask"])
    ->name('task.add');

    Route::post("task/add", [TaskManager::class, "addTaskPost"])
    ->name('task.add.post');

    Route::get("task/status/{id}", [TaskManager::class, "updateTaskStatus"])
    ->name('task.status.update');

    Route::get("task/delete/{id}", [TaskManager::class, "deleteTask"])
    ->name('task.delete');

    Route::get("task/edit/{id}", [TaskManager::class, "editTask"])
    ->name("task.edit");

    Route::post("task/edit/{id}", [TaskManager::class, "updateTask"])
    ->name("task.update");

});

