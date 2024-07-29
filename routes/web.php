<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Models\Kelas;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->get('/Login',[AuthController::class,'index'])->name('login');
Route::middleware('guest')->get('/Register',[AuthController::class,'registerForm'])->name('register');
Route::middleware('guest')->post('/addUser',[AuthController::class,'register'])->name('addUser');
Route::Post('/authenticate',[AuthController::class,'authenticate'])->name('authenticate');
Route::middleware(['auth'])->group(function () {
    Route::get('/Logout',[AuthController::class,'logout'])->name('logout');
Route::get('/', function () {
    $jumlahGuru=Teacher::count();
    $jumlahSiswa=Student::count();
    $jumlahKelas=Kelas::count();
    return view('Dashboard',[
        'guru'=>$jumlahGuru,
        'siswa'=>$jumlahSiswa,
        'kelas'=>$jumlahKelas,
    ]);
})->name('dashboard');
Route::get('/siswa', function () {
    return view('Siswa.Index');
})->name('siswa');
Route::resource('kelas', KelasController::class)->names([
    'index' => 'kelas.index',
    'create' => 'kelas.create',
    'store' => 'kelas.store',
    'show' => 'kelas.show',
    'edit' => 'kelas.edit',
    'update' => 'kelas.update',
    'destroy' => 'kelas.destroy',
]);
Route::resource('siswa', StudentController::class)->names([
    'index' => 'siswa.index',
    'create' => 'siswa.create',
    'store' => 'siswa.store',
    'show' => 'siswa.show',
    'edit' => 'siswa.edit',
    'update' => 'siswa.update',
    'destroy' => 'siswa.destroy',
]);
Route::resource('guru', TeacherController::class)->names([
    'index' => 'guru.index',
    'create' => 'guru.create',
    'store' => 'guru.store',
    'show' => 'guru.show',
    'edit' => 'guru.edit',
    'update' => 'guru.update',
    'destroy' => 'guru.destroy',
]);
});