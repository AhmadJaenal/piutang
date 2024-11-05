<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LandingPagesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\KontrakController;
use App\Http\Controllers\BidangController;

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
    return view('landingpages.landingpages');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route untuk halaman admin
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.home'); // File admin.master.blade.php
    })->name('admin');
});

// Route untuk halaman user
Route::middleware(['auth'])->group(function () {
    Route::get('/user', function () {
        return view('user.user'); // File user.user.blade.php
    })->name('user');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/', [App\Http\Controllers\LandingPagesController::class, 'landingpages'])->name('landingpages');
Route::get('/partnerPages', [App\Http\Controllers\LandingPagesController::class, 'partnerPages'])->name('partnerPages');
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'admin'])->name('admin');

// Users Routes
Route::get('/users', [UsersController::class, 'index'])->name('listUsers');
Route::get('/users/edit/{id}', [UsersController::class, 'edit'])->name('editUsers');
Route::put('/users/edit/{id}', [UsersController::class, 'update'])->name('updateUsers');
Route::delete('/users/{id}', [UsersController::class, 'destroy'])->name('deleteUsers');
Route::get('/users/trash', [UsersController::class, 'trash'])->name('trashUsers');
Route::put('/users/restore/{id}', [UsersController::class, 'restore'])->name('restoreUsers');
Route::patch('users/restore/{id}', [UsersController::class, 'restore'])->name('users.restore');
Route::delete('/users/force-delete/{id}', [UsersController::class, 'forceDelete'])->name('forceDeleteUsers');

// Employees Routes
Route::get('/employees', [EmployeesController::class, 'index'])->name('listEmployees');
Route::get('/employees/create', [EmployeesController::class, 'create'])->name('createEmployees');
Route::post('/employees', [EmployeesController::class, 'store'])->name('storeEmployees');
Route::get('/employees/edit/{id}', [EmployeesController::class, 'edit'])->name('editEmployees');
Route::put('/employees/edit/{id}', [EmployeesController::class, 'update'])->name('updateEmployees');
Route::delete('/employees/{id}', [EmployeesController::class, 'destroy'])->name('deleteEmployees');
Route::get('/employees/trash', [EmployeesController::class, 'trash'])->name('trashEmployees');
Route::put('/employees/restore/{id}', [EmployeesController::class, 'restore'])->name('restoreEmployees');
Route::patch('employees/restore/{id}', [EmployeesController::class, 'restore'])->name('employees.restore');
Route::delete('/employees/force-delete/{id}', [EmployeesController::class, 'forceDelete'])->name('forceDeleteEmployees');

// Fields Routes
Route::get('/fields', [BidangController::class, 'index'])->name('listFields');
Route::get('/fields/create', [BidangController::class, 'create'])->name('createFields');
Route::post('/fields', [BidangController::class, 'store'])->name('storeFields');
Route::get('/fields/edit/{id}', [BidangController::class, 'edit'])->name('editFields');
Route::put('/fields/edit/{id}', [BidangController::class, 'update'])->name('updateFields');
Route::delete('/fields/{id}', [BidangController::class, 'destroy'])->name('deleteFields');
Route::get('/fields/trash', [BidangController::class, 'trash'])->name('trashFields');
Route::put('/fields/restore/{id}', [BidangController::class, 'restore'])->name('restoreFields');
Route::patch('fields/restore/{id}', [BidangController::class, 'restore'])->name('fields.restore');
Route::delete('/fields/force-delete/{id}', [BidangController::class, 'forceDelete'])->name('forceDeleteFields');

// Partners Routes
Route::get('/partners', [PartnerController::class, 'index'])->name('listPartners');
Route::get('/partners/create', [PartnerController::class, 'create'])->name('createPartners');
Route::post('/partners', [PartnerController::class, 'store'])->name('storePartners');
Route::get('/partners/edit/{id}', [PartnerController::class, 'edit'])->name('editPartners');
Route::put('/partners/{id}', [PartnerController::class, 'update'])->name('updatePartners');
Route::delete('/partners/{id}', [PartnerController::class, 'destroy'])->name('deletePartners');
Route::get('/partners/trash', [PartnerController::class, 'trash'])->name('trashPartners');
Route::patch('/partners/{id}/restore', [PartnerController::class, 'restore'])->name('restorePartners');
Route::delete('/partners/{id}/forceDelete', [PartnerController::class, 'forceDelete'])->name('forceDeletePartners');

// Contracts Routes
Route::get('/kontraks', [KontrakController::class, 'index'])->name('listContracts');
Route::get('/kontraks/create', [KontrakController::class, 'create'])->name('createContracts');
Route::post('/kontraks', [KontrakController::class, 'store'])->name('storeContracts');
