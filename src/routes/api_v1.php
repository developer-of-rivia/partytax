<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PartyTaxService\api_v1\ExpensesController;


/* expenses */
Route::get('expenses', [ExpensesController::class, 'index']);
Route::get('expenses/{id}', [ExpensesController::class, 'show']);
Route::post('expenses', [ExpensesController::class, 'store']);
Route::put('expenses', [ExpensesController::class, 'edit']);


// Route::get('expenses/{id}/paiders', [ExpensesController::class, 'indexPaiders']);
// Route::get('expenses/{id}/paiders/{id}', [ExpensesController::class, 'indexPaiders']);



// Route::post('expenses', [ExpensesController::class, 'createExpenses']);
// Route::put('expenses', [ExpensesController::class, 'editExpense']);
// Route::delete('expenses', [ExpensesController::class, 'deleteExpense']);


/* */
// Route::delete('expenses', [ExpensesController::class, 'deleteExpense']);