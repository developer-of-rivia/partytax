<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\RoomController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Dashboard\MemberController;
use App\Http\Controllers\Dashboard\PaidersController;
use App\Http\Controllers\Dashboard\ExpensesController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\RoomSubscriberController;

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
        Route::get('/', [DashboardController::class, 'indexHomePage'])->name('dashboard.home');

        Route::group(['prefix' => 'room', 'middleware' => 'canRoomEditCheck'], function(){
            Route::get('/all-rooms', [DashboardController::class, 'indexAllRoomsPage'])->name('dashboard.all-rooms');
            Route::get('/create', [DashboardController::class, 'indexCreatePage'])->name('dashboard.create-page');
            Route::post('/create', [DashboardController::class, 'createRoom'])->name('dashboard.create');
            Route::get('/change/{id}', [DashboardController::class, 'changeRoom'])->name('dashboard.room.change');
            Route::get('/info', [RoomController::class, 'indexInfoPage'])->name('dashboard.room.info');
            Route::get('/results', [RoomController::class, 'indexResultsPage'])->name('dashboard.room.results');
            Route::get('/settings', [RoomController::class, 'indexSettingsPage'])->name('dashboard.room.settings')->middleware('canRoomPageEnter');
            Route::post('/settings', [RoomController::class, 'roomInfoUpdate'])->name('dashboard.room.update');

            /* members */
            Route::group(['prefix' => 'members'], function(){
                Route::get('/', [MemberController::class, 'index'])->name('dashboard.room.mebmers');
                Route::get('/add', [MemberController::class, 'create'])->name('dashboard.room.mebmers.add-page')->middleware('canRoomPageEnter');
                Route::post('/add', [MemberController::class, 'store'])->name('dashboard.room.mebmers.add');
                Route::get('/edit/{id}', [MemberController::class, 'edit'])->name('dashboard.room.members.edit');
                Route::get('/delete/{id}', [MemberController::class, 'destroy'])->name('dashboard.room.mebmers.remove');

                
                Route::get('/favs', [MemberController::class, 'indexFavsPage'])->name('dashboard.room.members.favs');
                Route::get('/favs/add', [MemberController::class, 'indexFavsAddPage'])->name('dashboard.room.members.favs.add-page');
            });

            /* expenses */
            Route::get('/expenses', [ExpensesController::class, 'index'])->name('dashboard.room.expenses');
            Route::get('/expenses/create', [ExpensesController::class, 'create'])->name('dashboard.room.expenses.create')->middleware('canRoomPageEnter');
            Route::post('/expenses/create', [ExpensesController::class, 'store'])->name('dashboard.room.expenses.store');
            Route::get('/expenses/{id}', [ExpensesController::class, 'show'])->name('dashboard.room.expenses.show');
            Route::get('/expenses/{id}/remove', [ExpensesController::class, 'remove'])->name('dashboard.room.expenses.remove');

            /* expense-paiders */
            Route::get('/expenses/{id}/paiders', [PaidersController::class, 'index'])->name('expenses.paiders')->middleware('canRoomPageEnter');
            Route::post('/expenses/{id}/paiders/update', [PaidersController::class, 'update'])->name('expenses.paiders.update');
            
            /* room subscribers */
            Route::get('/subscribers/add-page', [RoomSubscriberController::class, 'indexSubscribersAddPage'])->name('dashboard.subscribers.add-page');
            Route::post('/subscribers/add', [RoomSubscriberController::class, 'subscriberAdd'])->name('dashboard.subscribers.add');
            Route::delete('/subscribers', [RoomSubscriberController::class, 'subscriberRemove'])->name('dashboard.subscribers.remove');
        });
    });
});

require __DIR__.'/auth.php';