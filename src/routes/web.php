<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\RoomController;
use App\Http\Controllers\Dashboard\ExpensesController;
use App\Http\Controllers\Dashboard\MemberController;
use App\Http\Controllers\Dashboard\PaidersController;

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


Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // dashboard
    Route::group(['prefix' => 'dashboard', 'middleware' => 'generateDashboardBreadcrumbs'], function(){
        Route::get('/', [DashboardController::class, 'homepage'])->name('dashboard.home');

        Route::group(['prefix' => 'room'], function(){
            // все комнаты
            Route::get('/all-rooms', [DashboardController::class, 'indexRooms'])->name('dashboard');
            // создание комнаты
            Route::get('/create', [DashboardController::class, 'indexCreatePage'])->name('dashboard.create-page');
            Route::post('/create', [DashboardController::class, 'createRoom'])->name('dashboard.create');
            // смена комнаты
            Route::get('/change/{id}', [DashboardController::class, 'changeRoom'])->name('dashboard.room.change');

            /* подписки на комнаты */
            Route::get('/subscribers/add', [DashboardController::class, 'indexSubscribersAddPage'])->name('dashboard.subscribers.add-page');
            Route::post('/subscribers/add', [DashboardController::class, 'subscribersAdd'])->name('dashboard.subscribers.add');
            Route::get('/subscribers/{id}/remove', [DashboardController::class, 'subscribersRemove'])->name('dashboard.room.subscribers.remove');


            /* простые контроллеры для комнат */
            Route::get('/info', [RoomController::class, 'indexInfo'])->name('dashboard.room.info');
            Route::get('/results', [RoomController::class, 'indexResults'])->name('dashboard.room.results');
            Route::get('/settings', [RoomController::class, 'indexSettings'])->name('dashboard.room.settings');
            Route::post('/settings', [RoomController::class, 'roomUpdate'])->name('dashboard.room.update');

            /* members */
            Route::group(['prefix' => 'members'], function(){
                Route::get('/', [MemberController::class, 'indexMembers'])->name('dashboard.room.mebmers');
                Route::get('/add', [MemberController::class, 'addMemberPage'])->name('dashboard.room.mebmers.add-page');
                Route::post('/add/hzpoka', [MemberController::class, 'addMember'])->name('dashboard.room.mebmers.add');
                Route::get('/delete/{id}', [MemberController::class, 'removeMember'])->name('dashboard.room.mebmers.remove');
                Route::get('/favs', [MemberController::class, 'indexFavsPage'])->name('dashboard.room.members.favs');
                Route::get('/favs/add', [MemberController::class, 'indexFavsAddPage'])->name('dashboard.room.members.favs.add-page');
            });

            /* expenses */
            Route::get('/expenses', [ExpensesController::class, 'index'])->name('dashboard.room.expenses');
            Route::get('/expenses/create', [ExpensesController::class, 'create'])->name('dashboard.room.expenses.create');
            Route::post('/expenses/create', [ExpensesController::class, 'store'])->name('dashboard.room.expenses.store');
            Route::get('/expenses/{id}', [ExpensesController::class, 'show'])->name('dashboard.room.expenses.show');
            Route::get('/expenses/{id}/remove', [ExpensesController::class, 'remove'])->name('dashboard.room.expenses.remove');

            /* expense-paiders */
            Route::get('/expenses/{id}/paiders', [PaidersController::class, 'index'])->name('expenses.paiders');
            Route::post('/expenses/{id}/paiders/update', [PaidersController::class, 'update'])->name('expenses.paiders.update');

        });
    });
});

require __DIR__.'/auth.php';