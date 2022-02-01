<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\TimeSheetController;
// use App\Http\Controllers\PermissionController;
use App\Http\Controllers\DepartamentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();


Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('home');
    });
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    // Route::resource('permissions', PermissionController::class);

    Route::resource('departaments', DepartamentController::class);
    Route::resource('positions', PositionController::class);
    Route::resource('employees', EmployeeController::class);

    Route::get('time_sheets', [TimeSheetController::class, 'index'])->name('timesheets');
    Route::post('make-time-sheets', [TimeSheetController::class, 'makeTimeSheet'])->name('maketimesheets');
    Route::get('/employee/pdf', [TimeSheetController::class, 'createPDF']);

    Route::prefix('logs')->group(function () {
        Route::post('/list', [LogsController::class, 'list'])->name('logs.list');
        Route::get('/index', [LogsController::class, 'index'])->name('logs.index');

    });

    Route::get('set_active',[EmployeeController::class, 'changeActiveSearchEmployees']);
});
