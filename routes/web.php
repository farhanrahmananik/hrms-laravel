<?php

use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'permission:dashboard.view'])
    ->name('dashboard');

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/roles', [RoleController::class, 'index'])
            ->middleware('permission:role.view')
            ->name('roles.index');

        Route::get('/roles/create', [RoleController::class, 'create'])
            ->middleware('permission:role.create')
            ->name('roles.create');

        Route::post('/roles', [RoleController::class, 'store'])
            ->middleware('permission:role.create')
            ->name('roles.store');

        Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])
            ->middleware('permission:role.update')
            ->name('roles.edit');

        Route::put('/roles/{role}', [RoleController::class, 'update'])
            ->middleware('permission:role.update')
            ->name('roles.update');

        Route::delete('/roles/{role}', [RoleController::class, 'destroy'])
            ->middleware('permission:role.delete')
            ->name('roles.destroy');

        Route::get('/roles/{role}/permissions', [RoleController::class, 'editPermissions'])
            ->middleware('permission:permission.assign')
            ->name('roles.permissions.edit');

        Route::put('/roles/{role}/permissions', [RoleController::class, 'updatePermissions'])
            ->middleware('permission:permission.assign')
            ->name('roles.permissions.update');

        Route::get('/permissions', [PermissionController::class, 'index'])
            ->middleware('permission:permission.view')
            ->name('permissions.index');

        Route::get('/departments', [DepartmentController::class, 'index'])
            ->middleware('permission:department.view')
            ->name('departments.index');

        Route::get('/departments/create', [DepartmentController::class, 'create'])
            ->middleware('permission:department.create')
            ->name('departments.create');

        Route::post('/departments', [DepartmentController::class, 'store'])
            ->middleware('permission:department.create')
            ->name('departments.store');

        Route::get('/departments/{department}/edit', [DepartmentController::class, 'edit'])
            ->middleware('permission:department.update')
            ->name('departments.edit');

        Route::put('/departments/{department}', [DepartmentController::class, 'update'])
            ->middleware('permission:department.update')
            ->name('departments.update');

        Route::delete('/departments/{department}', [DepartmentController::class, 'destroy'])
            ->middleware('permission:department.delete')
            ->name('departments.destroy');

        Route::get('/designations', [DesignationController::class, 'index'])
            ->middleware('permission:designation.view')
            ->name('designations.index');

        Route::get('/designations/create', [DesignationController::class, 'create'])
            ->middleware('permission:designation.create')
            ->name('designations.create');

        Route::post('/designations', [DesignationController::class, 'store'])
            ->middleware('permission:designation.create')
            ->name('designations.store');

        Route::get('/designations/{designation}/edit', [DesignationController::class, 'edit'])
            ->middleware('permission:designation.update')
            ->name('designations.edit');

        Route::put('/designations/{designation}', [DesignationController::class, 'update'])
            ->middleware('permission:designation.update')
            ->name('designations.update');

        Route::delete('/designations/{designation}', [DesignationController::class, 'destroy'])
            ->middleware('permission:designation.delete')
            ->name('designations.destroy');
    });
