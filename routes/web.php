<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Select2Dropdown;

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
    return view('auth.register');
}); 

/*
Route::get('/dashboard', function () {
return view('google2fa.index');
})->name('dashboard');

 */

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/fa', [AuthController::class, 'checkTotp'])->name('fa')->middleware('auth');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

//Route::group(['middleware'=> ['auth:sanctum']],function(){
Route::middleware('web', 'auth')->group(function () {
    Route::get('/home', [AuthController::class, 'index'])->name('home')
        ->middleware(['totp.verification']);
    Route::get('/complete-registration', function () {
        return view('home');
    })->name('complete-registration')->middleware('auth');;
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
});
Route::get('/domain-selector', function () {
    return view('domain-selector');
})->middleware('cors');
Route::get('/', function () {
    return view('form');
});