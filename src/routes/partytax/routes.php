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



// Route::group(['middleware' => ['authCheck']], function(){
//     // partyTax
//     Route::group(['prefix' => 'partytax'], function(){
//         Route::get('/', [PartyTaxController::class, 'homepage'])->name('partytax-home');

//         Route::group(['prefix' => 'room'], function(){
//             // все комнаты
//             Route::get('/all-rooms', [PartyTaxController::class, 'indexRooms'])->name('partytax-rooms');
//             // создание комнаты
//             Route::get('/create', [PartyTaxController::class, 'indexCreatePage'])->name('partytax-rooms-create-page');
//             Route::post('/create', [PartyTaxController::class, 'createRoom'])->name('partytax-rooms-create');
//             // смена комнаты
//             Route::get('/change/{id}', [PartyTaxController::class, 'changeRoom'])->name('partytax-room-change');


//             /* */
//             Route::get('/subscribers/add', [PartyTaxController::class, 'indexSubscribersAddPage'])->name('partytax-rooms-subscribers-add-page');
//             Route::post('/subscribers/add', [PartyTaxController::class, 'subscribersAdd'])->name('partytax-rooms-subscribers-add');
//             Route::get('/subscribers/{id}/remove', [PartyTaxController::class, 'subscribersRemove'])->name('partytax-room-subscribers-remove');



//             /* простые контроллеры для комнат */
//             Route::get('/info', [RoomController::class, 'indexInfo'])->name('partytax-room-info');
//             Route::get('/results', [RoomController::class, 'indexResults'])->name('partytax-room-results');
//             Route::get('/settings', [RoomController::class, 'indexSettings'])->name('partytax-room-settings');
//             Route::post('/settings', [RoomController::class, 'roomUpdate'])->name('partytax-room-update');

//             /* members */
//             Route::group(['prefix' => 'members'], function(){
//                 Route::get('/', [MemberController::class, 'indexMembers'])->name('partytax-room-mebmers');
//                 Route::get('/add', [MemberController::class, 'addMemberPage'])->name('partytax-room-mebmers-add-page');
//                 Route::post('/add/hzpoka', [MemberController::class, 'addMember'])->name('partytax-room-mebmers-add');
//                 Route::get('/delete/{id}', [MemberController::class, 'removeMember'])->name('partytax-room-mebmers-remove');
//                 Route::get('/favs', [MemberController::class, 'indexFavsPage'])->name('partytax-room-members-favs');
//                 Route::get('/favs/add', [MemberController::class, 'indexFavsAddPage'])->name('partytax-room-members-favs-add-page');
//             });

//             /* expenses */
//             Route::get('/expenses', [ExpensesController::class, 'index'])->name('partytax.room.expenses');
//             Route::get('/expenses/create', [ExpensesController::class, 'create'])->name('partytax.room.expenses.create');
//             Route::post('/expenses/create', [ExpensesController::class, 'store'])->name('partytax.room.expenses.store');
//             Route::get('/expenses/{id}', [ExpensesController::class, 'show'])->name('partytax.room.expenses.show');
//             Route::get('/expenses/{id}/remove', [ExpensesController::class, 'remove'])->name('partytax.room.expenses.remove');

//             /* expense-paiders */
//             Route::get('/expenses/{id}/paiders', [PaidersController::class, 'index'])->name('expenses.paiders');
//             Route::post('/expenses/{id}/paiders/update', [PaidersController::class, 'update'])->name('expenses.paiders.update');

//         });
//     });
// });