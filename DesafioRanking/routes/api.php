<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\MovementController;
use App\Http\Controllers\PersonalRecordController;
use Illuminate\Support\Facades\Route;
use App\Utils\ResponseUtils;

// USER
Route::prefix('user')->group(
        function() {
            Route::get('/buscar-todos', 'App\Http\Controllers\UserController@buscarTodos');
            Route::get('/buscar-por-id/{id}', 'App\Http\Controllers\UserController@buscarPorId');
            Route::post('/inserir', 'App\Http\Controllers\UserController@inserir');
            Route::put('/atualizar/{id}', 'App\Http\Controllers\UserController@atualizar');
            Route::delete('/deletar/{id}', 'App\Http\Controllers\UserController@deletar');
        }
);

// MOVEMENT
Route::prefix('movement')->group(
    function() {
        Route::get('/buscar-todos', 'App\Http\Controllers\MovementController@buscarTodos');
        Route::get('/buscar-por-id/{id}', 'App\Http\Controllers\MovementController@buscarPorId');
        Route::post('/inserir', 'App\Http\Controllers\MovementController@inserir');
        Route::put('/atualizar/{id}', 'App\Http\Controllers\MovementController@atualizar');
        Route::delete('/deletar/{id}', 'App\Http\Controllers\MovementController@deletar');
    }
);

// PERSONAL-RECORD
Route::prefix('personal-record')->group(
    function() {
        Route::get('/buscar-todos', 'App\Http\Controllers\PersonalRecordController@buscarTodos');
        Route::get('/buscar-por-id/{id}', 'App\Http\Controllers\PersonalRecordController@buscarPorId');
        Route::post('/inserir', 'App\Http\Controllers\PersonalRecordController@inserir');
        Route::put('/atualizar/{id}', 'App\Http\Controllers\PersonalRecordController@atualizar');
        Route::delete('/deletar/{id}', 'App\Http\Controllers\PersonalRecordController@deletar');
    }
);

Route::get('/ranking/{idMovement}', 'App\Http\Controllers\RankingController@ranking');

Route::fallback(function()
{
    return ResponseUtils::responseBase([], "Endpoint nao encontrado", 404);
});
