<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\TicketCommentController;
use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function(){
    return response()-> json(
        [
            'message' => 'Welcome to Customer Support System API.'
        ]
    );
});

Route::group(['prefix' => '/ticket'], function() {
    Route::get('/',[TicketController::class,'index']);
    Route::get('/{id}',[TicketController::class,'show']);
    Route::post('/',[TicketController::class,'add']);
    Route::put('/{id}',[TicketController::class,'update']);
    Route::delete('/{id}',[TicketController::class,'delete']);

    
    // *  ___Ticket Comment___ 
    Route::group(['prefix' => '/{ticketId}/comment'], function(){
        Route::get('/',[TicketCommentController::class,'index']);
        Route::get('/{id}',[TicketCommentController::class,'show']);
        Route::post('/',[TicketCommentController::class,'store']);
        Route::delete('/{id}',[TicketCommentController::class,'delete']);
    });
});

Route::group(['prefix' => '/auth'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::get('/ref',[ReferenceController::class,'index']);
