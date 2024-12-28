<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\PartyTaxService\RoomController;
use App\Http\Controllers\PartyTaxService\PartyTaxController;
use App\Http\Controllers\PartyTaxService\ExpensesController;
use App\Http\Controllers\PartyTaxService\MemberController;
use App\Http\Controllers\PartyTaxService\PaidersController;

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



Route::group(['middleware' => ['authCheck']], function(){
    // partyTax
    Route::group(['prefix' => 'partytax'], function(){
        Route::get('/', [PartyTaxController::class, 'homepage'])->name('partytax-home');

        Route::group(['prefix' => 'room'], function(){
            // все комнаты
            Route::get('/all-rooms', [PartyTaxController::class, 'indexRooms'])->name('partytax-rooms');
            // создание комнаты
            Route::get('/create', [PartyTaxController::class, 'indexCreatePage'])->name('partytax-rooms-create-page');
            Route::post('/create', [PartyTaxController::class, 'createRoom'])->name('partytax-rooms-create');
            // присоединение к комнате
            Route::get('/join', [PartyTaxController::class, 'indexJoinPage'])->name('partytax-rooms-join-page');
            // смена комнаты
            Route::get('/change/{id}', [PartyTaxController::class, 'changeRoom'])->name('partytax-room-change');
            // забыть комнату
            Route::get('/forget/{id}', [PartyTaxController::class, 'forgetRoom'])->name('partytax-rooms-forget');

            /* простые контроллеры для комнат */
            Route::get('/info', [RoomController::class, 'indexInfo'])->name('partytax-room-info');
            Route::get('/results', [RoomController::class, 'indexResults'])->name('partytax-room-results');
            Route::get('/settings', [RoomController::class, 'indexSettings'])->name('partytax-room-settings');
           
            /* members */
            Route::group(['prefix' => 'members'], function(){
                Route::get('/', [MemberController::class, 'indexMembers'])->name('partytax-room-mebmers');
                Route::get('/add', [MemberController::class, 'addMemberPage'])->name('partytax-room-mebmers-add-page');
                Route::post('/add/hzpoka', [MemberController::class, 'addMember'])->name('partytax-room-mebmers-add');
                Route::get('/delete/{id}', [MemberController::class, 'removeMember'])->name('partytax-room-mebmers-remove');
                Route::get('/favs', [MemberController::class, 'indexFavsPage'])->name('partytax-room-members-favs');
                Route::get('/favs/add', [MemberController::class, 'indexFavsAddPage'])->name('partytax-room-members-favs-add-page');
            });

            /* expenses */
            Route::get('/expenses', [ExpensesController::class, 'index'])->name('partytax.room.expenses');
            Route::get('/expenses/create', [ExpensesController::class, 'create'])->name('partytax.room.expenses.create');
            Route::post('/expenses/create', [ExpensesController::class, 'store'])->name('partytax.room.expenses.store');
            Route::get('/expenses/{id}', [ExpensesController::class, 'show'])->name('partytax.room.expenses.show');
            
            /* expense-paiders */
            Route::get('/expenses/{id}/paiders', [PaidersController::class, 'index'])->name('expenses.paiders');
            Route::post('/expenses/{id}/paiders/update', [PaidersController::class, 'update'])->name('expenses.paiders.update');

        });
    });
});