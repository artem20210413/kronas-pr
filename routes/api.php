<?php

use App\Http\Controllers\CellController;
use App\Http\Controllers\DecorController;
use App\Http\Controllers\StoryMaterialController;
use App\Http\Controllers\TypeMaterialController;
use App\Http\Controllers\MaterialController;
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

Route::post('v1/cell/delete', [CellController::class, 'destroy']);
Route::put('v1/cell/update/{id}', function (Cell $cell) {
    return (new CellController)->update($cell);
});

Route::get('/users/{user}', function (User $user) {
    return $user->email;
});


//Route::get('test/{part_1?}/{part_2?}',[DecorController::class, 'testURL']);//test



Route::get('v1/material/help', [MaterialController::class, 'MaterialHelp']);
Route::get('v1/material', [MaterialController::class, 'MaterialGet']);
Route::post('v1/material', [MaterialController::class, 'MaterialPost']);
Route::delete('v1/material', [MaterialController::class, 'MaterialDelete']);

Route::get('v1/GG', [MaterialController::class, 'GG']); //TEST


Route::get('v1/story-material', [StoryMaterialController::class, 'StoryMaterialGet']);

//Route::get('v1/cell/{cell_id}/get', [CellController::class, 'CellId']);
Route::get('v1/cell', [CellController::class, 'CellGet']);
Route::post('v1/cell', [CellController::class, 'CellUpdate']);
Route::delete('v1/cell', [CellController::class, 'CellDestroy']);

Route::get('v1/decor', [DecorController::class, 'DecorGet']);
Route::post('v1/decor', [DecorController::class, 'DecorCreateAndUpdate']);
Route::delete('v1/decor', [DecorController::class, 'DecorDestroy']);

Route::get('v1/type-material', [TypeMaterialController::class, 'TypeMaterialGet']);
Route::post('v1/type-material', [TypeMaterialController::class, 'TypeMaterialCreate']);
Route::delete('v1/type-material', [TypeMaterialController::class, 'TypeMaterialDestroy']);

/** Admin User routes */
//Route::group(['middleware' => [Helper::getImplodeRoleNames([])]], static function () {
//    /** User  routes */
//    Route::get('/users', [UsersController::class, 'index']);
//    Route::get('/users/search/{name}', [UsersController::class, 'search']);
//    Route::get('/roles', [RolesController::class, 'index']);
//});
//Route::put('/services/{id}', [ServiceController::class, 'update']);
