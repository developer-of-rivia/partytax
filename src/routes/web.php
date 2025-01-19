<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\RegisterController;


use App\Http\Controllers\PartyTaxService\RoomController;
use App\Http\Controllers\PartyTaxService\PartyTaxController;
use App\Http\Controllers\PartyTaxService\ExpensesController;
use App\Http\Controllers\PartyTaxService\MemberController;

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


Route::get('/partytax', [IndexController::class, 'index']);

// Route::get('/', function(){
//     return redirect()->route('partytax-home');
// });

// Route::group(['middleware' => ['notAuthCheck']], function(){
//     // register
//     Route::get('register', [RegisterController::class, 'index'])->name('register-page');
//     Route::post('register', [RegisterController::class, 'create'])->name('register');
//     // auth
//     Route::get('sign-in', [AuthController::class, 'index'])->name('auth-page');
//     Route::post('sign-in', [AuthController::class, 'auth'])->name('auth');
// });


// Route::group(['middleware' => ['authCheck']], function(){
//     // logout
//     Route::get('logout', [AuthController::class, 'logout'])->name('logout');
//     // Account
//     Route::get('accout', [AccountController::class, 'index'])->name('account-page');
// });