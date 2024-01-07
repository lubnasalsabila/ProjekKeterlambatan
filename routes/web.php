<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RayonController;
use App\Http\Controllers\RombelController;
use App\Http\Controllers\StudentController;

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
    return view('home');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [UserController::class, 'loginAuth'])->name('login.auth');

Route::get('/error-permission', function() {
    return view('errors.permission');
})->name('error.permission');

Route::middleware('IsGuest')->group(function () {
    Route::get('/login', function () {
        return view('login');
    })->name('login');
    Route::post('/login', [UserController::class, 'loginAuth'])->name('login.auth');
});

Route::middleware(['IsLogin'])->group(function() {
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    
        Route::get('/home', function() {
            return view('home');
        })->name('home');
    });

    
Route::prefix('/terlambat')->name('terlambat.')->group(function (){
    Route::middleware('IsLogin', 'IsAdmin')->group(function() {
        Route::prefix('/admin')->name('admin.')->group(function (){
            Route::prefix('/user')->name('user.')->group(function (){
                Route::get('/', [UserController::class, 'index'])->name('index');
                Route::get('/create', [UserController::class, 'create'])->name('create');
                Route::post('/store', [UserController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
                Route::patch('/{id}', [UserController::class, 'update'])->name('update');
                Route::delete('/{id}', [UserController::class, 'destroy'])->name('delete');
            }); 
            Route::prefix('/rayon')->name('rayon.')->group(function (){
                Route::get('/', [RayonController::class, 'index'])->name('index');
                Route::get('/create', [RayonController::class, 'create'])->name('create');
                Route::post('/store', [RayonController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [RayonController::class, 'edit'])->name('edit');
                Route::put('/{id}', [RayonController::class, 'update'])->name('update');
                Route::delete('/{id}', [RayonController::class, 'destroy'])->name('delete');
            });
            Route::prefix('/rombel')->name('rombel.')->group(function (){
                Route::get('/', [RombelController::class, 'index'])->name('index');
                Route::get('/create', [RombelController::class, 'create'])->name('create');
                Route::post('/store', [RombelController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [RombelController::class, 'edit'])->name('edit');
                Route::put('/{id}', [RombelController::class, 'update'])->name('update');
                Route::delete('/{id}', [RombelController::class, 'destroy'])->name('delete');
            });
            Route::prefix('/siswa')->name('siswa.')->group(function (){
                Route::get('/', [StudentController::class, 'index'])->name('index');
                Route::get('/create', [StudentController::class, 'create'])->name('create');
                Route::post('/store', [StudentController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [StudentController::class, 'edit'])->name('edit');
                Route::put('/{id}', [StudentController::class, 'update'])->name('update');
                Route::delete('/{id}', [StudentController::class, 'destroy'])->name('delete');
            });
            Route::prefix('/keterlambatan')->name('keterlambatan.')->group(function (){
                Route::get('/', [LateController::class, 'index'])->name('index');
                Route::get('/rekapitulasi', [LateController::class, 'rekap'])->name('rekap');
                Route::get('/lihat/{student_id}', [LateController::class, 'lihat'])->name('lihat');
                Route::get('/create', [LateController::class, 'create'])->name('create');
                Route::post('/store', [LateController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [LateController::class, 'edit'])->name('edit');
                Route::put('/{id}', [LateController::class, 'update'])->name('update');
                Route::delete('/{id}', [LateController::class, 'destroy'])->name('delete');
                Route::get('/print/{id}', [LateController::class, 'show'])->name('print');
                Route::get('/download/{id}', [LateController::class, 'downloadPDF'])->name('download');
                Route::get('/export-excel', [LateController::class,  'createExcel'])->name('export');
            });
        });
    });
    Route::middleware('IsLogin', 'IsPs')->group(function() {
        Route::prefix('/ps')->name('ps.')->group(function() {
            Route::get('/student', [StudentController::class, 'index'])->name('student');
            Route::get('/', [LateController::class, 'index'])->name('index');
            Route::get('/rekapitulasi', [LateController::class, 'rekap'])->name('rekap');
            Route::get('/lihat/{student_id}', [LateController::class, 'lihat'])->name('lihat');
            Route::get('/print/{id}', [LateController::class, 'show'])->name('print');
            Route::get('/download/{id}', [LateController::class, 'downloadPDF'])->name('download-pdf');
            Route::get('/export-excel', [LateController::class,  'createExcel'])->name('export');
        });
    });
});
