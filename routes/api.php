<?php

use App\Http\Controllers\CellController;
use App\Models\Cell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Route::post('v1/cell',['App\Http\Controllers\CellController','set_cell']);

Route::post('v1/cell/delete', [CellController::class, 'destroy']);
Route::put('v1/cell/update/{id}', function (Cell $cell) {
    return (new CellController)->update($cell);
});

Route::get('/users/{user}', function (User $user) {
    return $user->email;
});

/** Admin User routes */
//Route::group(['middleware' => [Helper::getImplodeRoleNames([])]], static function () {
//    /** User  routes */
//    Route::get('/users', [UsersController::class, 'index']);
//    Route::get('/users/search/{name}', [UsersController::class, 'search']);
//    Route::get('/roles', [RolesController::class, 'index']);
//});
//Route::put('/services/{id}', [ServiceController::class, 'update']);
